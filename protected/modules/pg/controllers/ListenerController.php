<?php
/**
 * ListenerController
 *
 * @author tmazza
 */
class ListenerController extends PgController {

    public function actionIndex() {
      Yii::log("Requisição em " . date("d/m/Y H:i:s"), 'pg', 'pg.DefaultController.listener');

      # teste
      $_POST['notificationCode'] = '174B2BF2A462A46223D99422DFA50F3D73F2';
      $_POST['notificationType'] = 'transaction';
      # fim teste

      $nc = 'notificationCode'; $nt = 'notificationType';
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
            $pedido->status = Pedido::StatusAprovado;
            # TODO: inserir registro em user_bolao
            $pedido->update(['status']);
          }
      }
    }

}
