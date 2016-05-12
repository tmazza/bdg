<?php
/**
 * Description of MonitorController
 *
 * @author tiago
 */
class EditorController extends MainController {

    public function beforeAction($action){
      if(!Yii::app()->user->checkAccess('modEditor')){
        HView::ferr("Sem permissão de acesso.");
        $this->redirect($this->createUrl('/'));
      }
      return parent::beforeAction($action);
    }
}
