<?php
/**
 * ListenerController
 *
 * @author tmazza
 */
class ListenerController extends PgController {

    public function actionIndex() {
      Yii::log("Requisição em " . date("d/m/Y H:i:s"), 'pg', 'pg.DefaultController.listener');

      $nc = 'notificationCode'; $nt = 'notificationType';

      $_POST[$nc] = '145CFE25322F322F968BB4527F9DC0DD2DCD';
      $_POST[$nt] = 'transaction';

      $code = (isset($_POST[$nc]) && trim($_POST[$nc]) !== "" ? trim($_POST[$nc]) : null);
      $type = (isset($_POST[$nt]) && trim($_POST[$nt]) !== "" ? trim($_POST[$nt]) : null);

      if ($code && $type) {
          $notificationType = new PagSeguroNotificationType($type);
          $strType = $notificationType->getTypeFromValue();

          if($strType === 'TRANSACTION'){
            $this->transactionNotification($code);
          } elseif($strType === 'APPLICATION_AUTHORIZATION') {
            $this->authorizationNotification($code);
          } elseif($strType === 'PRE_APPROVAL'){
            $this->preApprovalNotification($code);
          } else {
            Yii::log("Tipo de requisição desconhecido" . date("d/m/Y H:i:s"), 'pg', 'pg.DefaultController.listener');
          }
      } else {
          Yii::log("Requisição inválida." . ' | ' . date("d/m/Y H:i:s"), 'pg', 'pg.DefaultController.listener');
      }

    }

    private function transactionNotification($notificationCode) {
        Yii::log("TRANSACTION identificada." . ' | ' . date("d/m/Y H:i:s"), 'pg', 'pg.DefaultController.listener');
        $credentials = PagSeguroConfig::getAccountCredentials();
        try {
            $transaction = PagSeguroNotificationService::checkTransaction($credentials, $notificationCode);
            $this->trataTransacao($transaction);
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    private function authorizationNotification($notificationCode) {
        Yii::log("PRE_APPROVAL identificada." . ' | ' . date("d/m/Y H:i:s"), 'pg', 'pg.DefaultController.listener');
    }

    private function preApprovalNotification($preApprovalCode) {
        Yii::log("APPLICATION_AUTHORIZATION identificada." . ' | ' . date("d/m/Y H:i:s"), 'pg', 'pg.DefaultController.listener');
    }

    /**
     * Status posíveis
     * 1 Aguardando pagamento: o comprador iniciou a transação, mas até o momento o PagSeguro não recebeu nenhuma informação sobre o pagamento.
     * 2 Em análise: o comprador optou por pagar com um cartão de crédito e o PagSeguro está analisando o risco da transação.
     * 3 Paga: a transação foi paga pelo comprador e o PagSeguro já recebeu uma confirmação da instituição financeira responsável pelo processamento.
     * 4 Disponível: a transação foi paga e chegou ao final de seu prazo de liberação sem ter sido retornada e sem que haja nenhuma disputa aberta.
     * 5 Em disputa: o comprador, dentro do prazo de liberação da transação, abriu uma disputa.
     * 6 Devolvida: o valor da transação foi devolvido para o comprador.
     * 7 Cancelada: a transação foi cancelada sem ter sido finalizada.
     */
    private function trataTransacao($transaction){
      $id = (int) $transaction->getReference();
      $pedido = Pedido::model()->findByPk($id);
      if(!is_null($pedido) && $transaction->getStatus()->getValue() == 3){
          if($pedido->status == Pedido::StatusAguardando){

            $transaction = Yii::app()->db->beginTransaction();

            $pedido->status = Pedido::Statuspago;
            $userBolao = new UserBolao();
            $userBolao->idUsuario = $pedido->idUsuario;
            $userBolao->idBolao = $pedido->idBolao;
            $userBolao->status = UserBolao::StatusAtivo;

            if($userBolao->save()){
              HEmail::toAdmin("Pagamento aprovado. Novo usuário.");
              # Enviar email para usuário
              $user = User::model()->findByPk((int)$pedido->idUsuario);
              HEmail::comTemplate($user->email,"Conta ativada","Sua conta no Bolão do gordo foi ativada.","_emailContaAtivada");
              # Atualiza status do pedido
              if($pedido->update(['status'])){
                $transaction->commit();
              } else {
                HEmail::toAdmin("Pedido: {$pedido->id}. Ao atualizar pedido.","**Erro ao processar pagamento de usuário.");
                $transaction->rollback();
              }
            } else {
              $transaction->rollback();
              HEmail::toAdmin("Pedido: {$pedido->id}. Ao salvar user_bolao","**Erro ao processar pagamento de usuário");
            }

            # TODO: inserir registro em user_bolao
            $pedido->update(['status']);
          }
      }
    }

}
