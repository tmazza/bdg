<?php
class BolaoController extends MainController {

  public function actionIndex($id){
    $bolao = Bolao::model()->findByPk((int)$id);
    if(is_null($bolao)){
      HView::ferr("Bolão não existe.");
      $this->redirect($this->createUrl('/site/index'));
    } else {
      $this->render('index',['bolao'=>$bolao]);
    }
  }

  public function actionInscricaoGratuita($id){
    $bolao = Bolao::model()->findByPk((int)$id);
    if(!is_null($bolao) && $bolao->tipoInscricao == Bolao::TipoAberto){
      $userBolao = new UserBolao();
      $userBolao->idUsuario = $this->user->id;
      $userBolao->idBolao = (int)$id;
      $userBolao->status = UserBolao::StatusAtivo;
      if($userBolao->save()){
        HView::finf("Bem vindo(a)");
        $this->redirect($this->createUrl('/bolao/index',['id'=>$id]));
      }
    }
    HView::ferr("Ops. Algo deu errado. Tente novamente.");
    $this->redirect($this->createUrl('/site/index'));
  }

}
