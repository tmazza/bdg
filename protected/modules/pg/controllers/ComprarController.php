<?php
/**
 * ComprarController
 *
 * @author tmazza
 */
class ComprarController extends PgController {

    /**
     * @param $id ID do bolão sendo comprado
     * @param $rt URL de retorno em caso de erro codificada em base64
     */
    public function actionBolao($id,$rt=false) {
      $bolao = Bolao::model()->findByPk((int)$id);
      if(is_null($bolao)){
        HView::ferr("Bolão não encontrado.");
      } else {
        $url = PaymentRequestGenerator::pagamentoBolao($bolao);
        if($url){
          $this->redirect($url);
        } else {
          HView::ferr("Ops. Não foi possível gerar a solicitação de pagamento. Tente mais um vez.");
        }
      }
      if($rt){
        $this->redirect($this->createUrl(base64_decode($rt)));
      } else {
        $this->redirect($this->createUrl('/site/index'));
      }
    }

    public function actionListener(){
      Yii::log("Requisição em " . date("d/m/Y H:i:s"), 'pg', 'pg.DefaultController.listener');
      $_POST['notificationCode'] = '';
      $_POST['notificationType'] = '';
      NotificationListener::main();
    }


}
