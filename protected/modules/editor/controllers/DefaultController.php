<?php
/**
 * DefaultController
 *
 * @author tmazza
 */
class DefaultController extends EditorController {

    public function actionIndex() {
      $this->render('index', []);
    }
    
}
