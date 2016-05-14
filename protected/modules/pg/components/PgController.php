<?php
/**
 * Description of MonitorController
 *
 * @author tiago
 */
class PgController extends MainController {

    public function beforeAction($action){
      if(Yii::app()->user->isGuest){
        HView::finf("Identifique-se");
        $this->redirect($this->createUrl('/site/login'));
      }

      return parent::beforeAction($action);
    }
}
