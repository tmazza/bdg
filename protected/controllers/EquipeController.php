<?php
class EquipeController extends MainController {

  public function actionLista(){
    $equipes = Equipe::model()->findAll([
      'order' => 'nome ASC',
    ]);
    $this->render('lista',[
      'equipes' => $equipes,
    ]);
  }

}
