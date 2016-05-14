<?php
/**
 * DefaultController
 *
 * @author tmazza
 */
class DefaultController extends PgController {

    public function actionIndex() {
      $bolao = Bolao::model()->find();

      $url = PaymentRequestGenerator::pagamentoBolao($bolao);
      if($url){
        echo $url;
        exit;
        $this->redirect($url);
      } else {
        HView::ferr("Ops. Não foi possível gerar a solicitação de pagamento. Tente mais um vez.");
      }
      $this->render('index', []);
    }

    public function actionListener(){
      Yii::log("Requisição em " . date("d/m/Y H:i:s"), 'pg', 'pg.DefaultController.listener');
      $_POST['notificationCode'] = '';
      $_POST['notificationType'] = '';
      NotificationListener::main();
    }


}
