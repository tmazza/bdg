<?php
class SiteController extends MainController {

  protected function beforeAction($action){
    return parent::beforeAction($action);
  }

  public function actionIndex(){
    if(Yii::app()->user->isGuest){
      Yii::app()->theme = '2017onlyHome';
      $this->render('home');
    } else {
      
      $boloesInscritos = $this->user->boloesInscritos;

      $boloesNaoInscritos = Bolao::model()
          ->userNaoInscrito()
          ->ativo()
          ->naoEncerrado()
          ->findAll();

      $boloesEncerrados = Bolao::model()
          ->ativo()
          ->encerrado()
          ->findAll();
        
      $this->render('index',[
        'boloesNaoInscritos'=>$boloesNaoInscritos,
        'boloesInscritos'=>$boloesInscritos,
        'boloesEncerrados'=>$boloesEncerrados,
      ]);
    }
  }

  public function actionLogin($rt=false) {
    $this->trataLoginSocial();
    $model = new LoginForm;
    if (isset($_POST['LoginForm'])) {
        $model->attributes = $_POST['LoginForm'];
        if ($model->validate() && $model->login()) {
            User::saveLogin();
            HView::finf('Olá ' . Yii::app()->user->nome,$this->createUrl('/site/index'));
            if($rt !== false){
              $this->redirect($this->createUrl(base64_decode($rt)));
            } else {
              $this->redirect($this->createUrl('/site/index'));
            }
        } else {
          $erros = $model->getErrors();
          $erro = array_shift($erros);
          HView::ferr($erro[0]);
        }
    }
    $this->render('login', array('model' => $model,'isCard'=>true,'showRecovery'=>true));
  }

  /**
   * Logs out the current user and redirect to homepage.
   */
  public function actionLogout() {
      Yii::app()->user->logout(FALSE);
      $this->redirect(Yii::app()->homeUrl);
  }


  private function trataLoginSocial(){
    $serviceName = Yii::app()->request->getQuery('service');
    if (isset($serviceName)) {
        $eauth = Yii::app()->eauth->getIdentity($serviceName);
        $eauth->redirectUrl = $this->createAbsoluteUrl('/site/index');
        $eauth->cancelUrl = $this->createAbsoluteUrl('/site/login');
        try {
            if ($eauth->authenticate()) {
                $identity = new EAuthUserIdentity($eauth);
                if ($identity->authenticate()) {
                    Yii::app()->user->login($identity, 60 * 60 * 24 * 7);
                    $eauth->redirect();
                } else {
                    $eauth->cancel();
                }
            }
            $this->redirect(array('/site/login'));
        } catch (EAuthException $e) {
            Yii::app()->user->setFlash('error', 'EAuthException: '.$e->getMessage()); // save authentication error to session
            $eauth->redirect($eauth->getCancelUrl()); // close popup window and redirect to cancelUrl
        }
    }
  }

}
