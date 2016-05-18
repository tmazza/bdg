<?php
class BolaoController extends MainController {

  public function beforeAction($action){
    $this->layout = '//layouts/menuDireita';
    return parent::beforeAction($action);
  }

  private function setMenuLateral($bolao){
    $this->menuLateral = [
      ['index','Em aberto',$this->createUrl('/bolao/index',['id'=>$bolao->idBolao])],
      ['fechado','Fechados',$this->createUrl('/bolao/fechado',['id'=>$bolao->idBolao])],
      ['classificacao','Ranking','#!'],
    ];
  }

  public function actionIndex($id){
    $bolao = $this->getBolao($id);
    $this->tabelaBrasileirao=true;
    $this->setMenuLateral($bolao);
    $this->render('index',['bolao'=>$bolao]);
  }

  public function actionFechado($id){
    $bolao = $this->getBolao($id);
    $this->setMenuLateral($bolao);
    $this->render('fechado',['bolao'=>$bolao]);
  }

  public function actionInscricaoPaga($id){
    $bolao = Bolao::model()->findByPk((int)$id);
    if(!is_null($bolao) && $bolao->tipoInscricao == Bolao::TipoPago){
      $userBolao = new UserBolao();
      $userBolao->idUsuario = $this->user->id;
      $userBolao->idBolao = (int)$id;
      $userBolao->status = UserBolao::StatusPendente;
      if($userBolao->save()){
        HView::finf("Bem-vindo(a).");
        $this->redirect($this->createUrl('/bolao/index',['id'=>$id]));
      }
    }
    HView::ferr("Ops. Algo deu errado. Tente novamente.");
    $this->redirect($this->createUrl('/site/index'));
  }

  public function actionInscricaoGratuita($id){
    $bolao = Bolao::model()->findByPk((int)$id);
    if(!is_null($bolao) && $bolao->tipoInscricao == Bolao::TipoAberto){
      $userBolao = new UserBolao();
      $userBolao->idUsuario = $this->user->id;
      $userBolao->idBolao = (int)$id;
      $userBolao->status = UserBolao::StatusAtivo;
      if($userBolao->save()){
        HView::finf("Bem-vindo(a).");
        $this->redirect($this->createUrl('/bolao/index',['id'=>$id]));
      }
    }
    HView::ferr("Ops. Algo deu errado. Tente novamente.");
    $this->redirect($this->createUrl('/site/index'));
  }

  public function actionSalvaPalpite(){
    if(isset($_POST['dia']) && isset($_POST['bolao'])){
      $dia = (int) $_POST['dia'];
      $idBolao = (int) $_POST['bolao'];
      unset($_POST['dia'],$_POST['bolao']);
      // Busca jogos do dia
      $bolao = $this->getBolao($idBolao);
      $jogos = $bolao->campeonato->jogosNesteDia($dia);
      // Busca hora de fechamento do dia
      $fechamento = $bolao->getHoraFechamento($jogos);
      $idsJogos = array_map(function($i){return $i->idJogo;},$jogos);
      foreach ($_POST as $j => $palpite) {
        $idJogo = (int) $j;
        if(in_array($j,$idsJogos)){
          $model = Palpite::model()->findByPk([
            'idBolao'=>$bolao->idBolao,
            'idUsuario'=>$this->user->id,
            'idJogo'=>$idJogo,
          ]);
          if(is_null($model)){
            $model = new Palpite();
            $model->idBolao=$bolao->idBolao;
            $model->idUsuario=$this->user->id;
            $model->idJogo=$idJogo;
          }
          $camposParaUpdate=[];
          if(isset($palpite['casa']) && strlen($palpite['casa']) > 0){
            $model->golsMandante=(int)$palpite['casa'];
            $camposParaUpdate[] = 'golsMandante';
          }
          if(isset($palpite['visi']) && strlen($palpite['visi']) > 0){
            $model->golsVisitante=(int)$palpite['visi'];
            $camposParaUpdate[] = 'golsVisitante';
          }
          if(count($camposParaUpdate) > 0){
            if($model->isNewRecord){
              $model->save();
            } else {
              $model->update($camposParaUpdate);
            }
          }
        }
      }
      sleep(1);
      $this->renderPartial('__formJogo',[
        'dia'=>$dia,
        'jogos'=>$jogos,
        'bolao'=>$bolao,
      ]);
    }
  }

  public function actionLoadTabBra(){
    $this->renderPartial('/bolao/_tabelaBrasileirao');
  }

  private function getBolao($id){
    $bolao = Bolao::model()->findByPk((int)$id);
    if(is_null($bolao) || !$this->isUserInscritoNoBolao($bolao)){
      HView::ferr("Bolão não existe.");
      $this->redirect($this->createUrl('/site/index'));
    }
    return $bolao;
  }

  private function isUserInscritoNoBolao($bolao){
      return in_array($bolao->idBolao,array_keys($this->user->boloesInscritos));
  }


}
