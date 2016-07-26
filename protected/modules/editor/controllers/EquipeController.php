<?php
/**
 * EquipeController
 *
 * @author tmazza
 */
class EquipeController extends EditorController {

  public function actionIndex() {
    $equipes = Equipe::model()->findAll(['order'=>'tipo']);
    $this->render('index', [
      'equipes'=>$equipes,
    ]);
  }

}
