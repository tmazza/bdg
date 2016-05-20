<?php
class RegulamentoController extends MainController {

  public function actionGeral(){
    $this->render('geral');
  }

  public function actionBolao($id){
    $bolao = Bolao::model()->findByPk((int)$id);
    if(is_null($bolao)){
      echo "Bolão não encontrado.";
    } else {
      $this->renderPartial('_bolao',[
        'bolao'=>$bolao,
      ]);
    }
  }

}
