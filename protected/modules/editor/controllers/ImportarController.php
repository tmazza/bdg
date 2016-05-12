<?php
/**
 * ImportarController
 *
 * @author tmazza
 */
class ImportarController extends EditorController {

    public function actionIndex() {

      $model = new ImportaJogos();
      $jogos = [];

      if(isset($_POST['ImportaJogos'])){
        $model->attributes = $_POST['ImportaJogos'];
        if($model->validate()){
          $jogos = $model->aplicaFormato();
        }
      }
      $this->render('index', [
        'model'=>$model,
        'jogos'=>$jogos,
      ]);
    }

}
