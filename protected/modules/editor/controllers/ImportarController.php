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
      $campeonatos = CHtml::listData(Campeonato::model()->findAll(),'codigo','nome');

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
        'campeonatos'=>$campeonatos,
      ]);
    }

    public function actionSalvar(){
      if(isset($_POST['jogos']) && isset($_POST['campeonato'])){
        $campeonato = $_POST['campeonato'];
        $jogos = json_decode($_POST['jogos'],true);

        $transaction = Yii::app()->db->beginTransaction();
        $ok = true;

        foreach ($jogos as $j) {

          list($dia,$mes) = explode('/',$j['DATA']);
          list($hora,$min) = explode(':',$j['HORA']);
          $timeStamp = mktime($hora,$min,0,$mes,$dia,date('Y'));
          $dateTime = date('Y-m-d H:i:s',$timeStamp);

          $model = new Jogo();
          $model->codCampeonato = $campeonato;
          $model->equipeMandante = $j['CASA'];
          $model->equipeVisitante = $j['VISITANTE'];
          $model->data = $dateTime;
          $model->numJogo = $j['NUM'];
          $ok = $model->save() ? $ok : false;

        }
        if($ok){
          HView::fsuc(count($jogos) . " jogos cadastrados");
          $transaction->commit();
        } else {
          HView::ferr("Erro ao cadastrar jogos.");
          $transaction->rollback();
        }
        $this->redirect($this->createUrl('/editor/default/index'));
      } else {
        HView::ferr("Requisição inválida.");
        $this->redirect($this->createUrl('/site/index'));
      }
    }

}
