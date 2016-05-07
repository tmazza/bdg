<?php

class AtivarController extends MainController {

  public function actionIndex($u){
    $user = null;
    if(strlen($u) > 1){
      $user = User::model()->findByAttributes(array(
        'key' => $u,
      ));
    }
    if(is_null($user)){
      $this->render('naoEncontrado');
    } else {
      $user->scenario = 'register';
      if($user->status == 0){
        if(isset($_POST['User'])){
          $user->attributes = $_POST['User'];
          if($user->validate()){
            $user->senha = CPasswordHelper::hashPassword($user->senha);
            $user->status = 1; // Marca como usuário ativo
            $user->update(array('nome','senha','status'));
            Yii::app()->authManager->assign('cliente',$user->id);
            $this->fazerLogin($user);
          }
        }

        $this->render('index',array(
          'user' => $user,
        ));
      } else {
        $this->redirect($this->createUrl('/site/login'));
      }
    }
  }

  private function fazerLogin($user){
    $identity = new UserIdentity($user->email, $user->senha2);
    $identity->authenticate();
    if(Yii::app()->user->login($identity, 60 * 60 * 24 * 7)){
      User::saveLogin();
      HView::finf('Olá ' . Yii::app()->user->nome);
      $this->redirect('/site/index');
    } else {
      $this->redirect($this->createUrl('/site/login'));
    }
  }


}
