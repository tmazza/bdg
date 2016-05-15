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
    
}
