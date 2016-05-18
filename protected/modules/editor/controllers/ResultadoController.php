<?php
/**
 * ResultadoController
 * Calculo do resultado de um rodada/dia
 * @author tmazza
 */
class ResultadoController extends EditorController {

    public function actionIndex() {
      $campeonatos = Campeonato::model()->findAll();
      $this->render('index',[
        'campeonatos'=>$campeonatos,
      ]);
    }

    public function actionRodadas($id){
      $campeonato = Campeonato::model()->findByPk(substr($id,0,5));

      if(isset($_POST['dia'])){
        $this->proecessaRodada($id);
      }

      $this->render('rodadas',[
        'campeonato'=>$campeonato,
        'dias'=>$campeonato->jogosPorDiaFechados(),
      ]);
    }

    private function proecessaRodada($id){
      echo 'TODO';
    }

}
