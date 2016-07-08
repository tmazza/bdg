<?php

class ConfiguracaoController extends MainController {

  public function actionIndex(){

    $model = new Configuracao();
    $model->emailFechaDia = $this->user->emailFechaDia;
    $model->emailAvisoFechaDia = $this->user->emailAvisoFechaDia;
    $model->faceAvisoFechaDia = $this->user->faceAvisoFechaDia;

    if(isset($_POST['Configuracao'])){ 
      $model->attributes = $_POST['Configuracao'];
      if($model->validate()){
        $this->user->emailFechaDia = $model->emailFechaDia;
        $this->user->emailAvisoFechaDia = $model->emailAvisoFechaDia;
        $this->user->faceAvisoFechaDia = $model->faceAvisoFechaDia;
        if($this->user->update(['emailFechaDia','emailAvisoFechaDia','faceAvisoFechaDia']) > 0){
          HView::fsuc("Alterações salvas.");          
        } else {
          HView::finf("Nada modificado.");          
        }
      }
    }

    $this->render('index',[
      'model'=>$model,
    ]);
  }

}
