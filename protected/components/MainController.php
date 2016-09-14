<?php
/**
 * Utilizado por todos Controller's da aplicação
 */
class MainController extends CController  {

    const fsuc = 'flash-success';
    const ferr = 'flash-error';
    const finf = 'flash-info';

    public $sentEmails = 0;

    public $assetsDir;
    public $pagTitulo = 'Bolão do gordo';
    public $pagDescricao = '';
    public $pagPalavras = '';
    public $user = false;

    public $menuLateral = [];


    protected function beforeAction($action) {
        $this->setUser();
        $this->addScripts();
        return parent::beforeAction($action);
    }

    private function setUser(){
      if(!Yii::app()->user->isGuest){
        $user = User::model()->findByPk((int)Yii::app()->user->id);
        $action = strtolower($this->action->id);
        $semCadastro = ['logout','error'];
        if(!in_array($action,$semCadastro)){
          if(is_null($user)){
            $this->redirect($this->createUrl('/site/logout'));
          } else {
            $this->user = $user;
          }
        }
      }
    }

    private function addScripts(){
      $this->assetsDir = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.webroot'), false, -1, YII_DEBUG ? true : null);
      if (Yii::app()->request->isAjaxRequest) {
        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
        Yii::app()->clientScript->scriptMap['jquery-ui.js'] = false;
        Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
      } else {
        Yii::app()->clientScript->registerCoreScript('jquery');
      }
    }

    public function actionError() {
        $erro = Yii::app()->errorHandler->error;
        if(!in_array($erro['code'],array(400,401,402,403,404)) && $this->sentEmails < 5 && !YII_DEBUG){
          $msg = array();
          $msg['erro'] = Yii::app()->errorHandler->error;
          $msg['request'] = Yii::app()->request;
          $msg['user'] = Yii::app()->user;
          HEmail::templateSimples(Yii::app()->params['adminEmail'],"BdG: Erro {$erro['code']}", "<p>{$erro['message']}</p><p>" . (Yii::app()->user->isGuest ? 'Guest' : Yii::app()->user->id) .  "</p><p>{$erro['file']}</p><p>{$erro['line']}</p><pre>" .json_encode($msg)."</pre>");
          $this->sentEmails++;
        }
        $this->render('application.views.main.erro',array(
          'erro' => $erro,
        ));
    }

}
