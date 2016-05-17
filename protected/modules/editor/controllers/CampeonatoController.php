<?php
/**
 * CampeonatoController
 *
 * @author tmazza
 */
class CampeonatoController extends EditorController {

    public function actionIndex() {
      $campeonatos = Campeonato::model()->findAll();
      $this->render('index', [
        'campeonatos'=>$campeonatos,
      ]);
    }

    public function actionEditar($id){
      $model = Campeonato::model()->findByPk($id);
      if(isset($_POST['Campeonato'])){
        $model->attributes = $_POST['Campeonato'];
        if($model->save()){
          HView::fsuc("Ok.");
          $this->redirect($this->createUrl('/editor/campeonato/index'));
        }
      }
      $this->render('editar',[
        'model'=>$model,
      ]);
    }

    public function actionEditarJogos($id){
      $model = Campeonato::model()->findByPk($id);
      $equipes = CHtml::listData(Equipe::model()->findAll(),'id','nome');
      $this->render('editarJogos',[
        'model'=>$model,
        'equipes'=>$equipes,
      ]);
    }

    public function actionUpdateJogo(){
      if(isset($_POST['id'])){
        $jogo = Jogo::model()->findByPk((int)$_POST['id']);
        $jogo->attributes = $_POST;
        echo $jogo->update(['numJogo','data','equipeMandante','equipeVisitante']) > 0 ? 'OK' : 'NO';
      }
    }

}
