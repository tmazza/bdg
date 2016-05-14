<?php
/**
 * DefaultController
 *
 * @author tmazza
 */
class DefaultController extends PgController {

    public function actionIndex() {
      $boloes = Bolao::model()->findAll();
      $this->render('index', [
        'boloes' => $boloes,
      ]);
    }

    public function actionListener(){
      Yii::log("Requisição em " . date("d/m/Y H:i:s"), 'pg', 'pg.DefaultController.listener');
      $_POST['notificationCode'] = '';
      $_POST['notificationType'] = '';
      NotificationListener::main();
    }


}
