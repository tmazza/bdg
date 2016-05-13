<?php
/**
 * DefaultController
 *
 * @author tmazza
 */
class DefaultController extends PgController {

    public function actionIndex() {
      $this->render('index', []);
    }

}
