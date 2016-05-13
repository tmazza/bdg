<?php
/**
 * ImportarController
 *
 * @author tmazza
 */
class ImportarController extends EditorController {

    public function actionIndex() {

      $model = new ImportaJogos();
      $equipes = Equipe::model()->findAll(['index'=>'id']);
      $jogos = [];

      if(isset($_POST['ImportaJogos'])){
        $model->attributes = $_POST['ImportaJogos'];
        if($model->validate()){
          $nomes = CHtml::listData($equipes,'id',function($m){ return strtolower($m->nome); });
          $model->codJogos = str_replace($nomes,array_keys($nomes),strtolower($model->jogos));
          $jogos = $model->aplicaFormato();
        }
      }
      $this->render('index', [
        'model'=>$model,
        'jogos'=>$jogos,
        'equipes'=>$equipes,
      ]);
    }

    public function actionSalvar(){
      if(isset($_POST['jogos'])){
        $jogos = json_decode($_POST['jogos'],true);
        echo '<h1>\\o/</h1> <br>TODO!<br><pre>';
        print_r($jogos);
        exit;
      } else {
        HView::ferr("Requisição inválida.");
        $this->redirect($this->createUrl('/site/index'));
      }
    }

}
