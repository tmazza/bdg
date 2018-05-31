<?php

class CadastroController extends MainController {

  public function actionIndex(){
    $this->centerLogo = true;
    $this->layout = 'mainNoBox';
    $model = new CadastroForm;

    if (isset($_POST['CadastroForm'])) {
        $model->attributes = $_POST['CadastroForm'];
        if($model->validate()){
          $user = User::model()->add($model);
          if($user){
            if($model->logaUsuario($user)){
              HView::fsuc('Olá ' . $user->nome);
              HEmail::templateSimples($user->email,"Sua conta foi criada ","Seja bem-vindo(a)<br><br>" . CHtml::link('Acesse sua conta',Yii::app()->params['domain']));
              HEmail::templateSimples(Yii::app()->params['adminEmail'],"Novo usuário!",$user->nome . ' <br> ' . $user->email);
            }
          }
          $this->redirect($this->createUrl('/site/index'));
        }
    }

    $this->render('index',array(
      'model' => $model,
    ));
  }

}
