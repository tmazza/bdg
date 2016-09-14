<?php
class BolaoController extends MainController {

  public $boloesInscritos = null;

  public function beforeAction($action){
    if(!Yii::app()->user->checkAccess('cliente')){
      HView::ferr("Acesse sua conta.");
      $this->redirect($this->createUrl('/site/login'));
    }
    return parent::beforeAction($action);
  }

  private function setMenuLateral($bolao){
    $labelRank = '<i class="uk-icon uk-icon-trophy"></i><span class="uk-hidden-small"> &nbsp;Ranking</span>';
    $labelStat = '<i class="uk-icon uk-icon-bar-chart"></i><span class="uk-hidden-small"> &nbsp;Estatísticas</span>';
    $this->menuLateral = [];
    if(!$bolao->isEncerrado){
      $this->menuLateral[] = ['index','Em aberto',$this->createUrl('/bolao/index',['id'=>$bolao->idBolao])];
    }
    $this->menuLateral[] = ['fechado','Fechados',$this->createUrl('/bolao/fechado',['id'=>$bolao->idBolao])];
    $this->menuLateral[] = ['ranking',$labelRank,$this->createUrl('/bolao/ranking',['id'=>$bolao->idBolao])];
    $this->menuLateral[] = ['estatistica',$labelStat,$this->createUrl('/bolao/estatistica',['id'=>$bolao->idBolao])];
  }

  public function actionIndex($id){
    $bolao = $this->getBolao($id);

    if($bolao->isEncerrado){ # Bolão encerrado tem como página inicial o ranking
      $this->redirect($this->createUrl('/bolao/ranking',[
        'id' => $id,
      ]));
    }
    $this->setMenuLateral($bolao);
    $this->render('index',[
      'bolao'=>$bolao,
    ]);
  }

  public function actionFechado($id,$listaCompleta=false){
    $bolao = $this->getBolao($id);
    $this->setMenuLateral($bolao);
    $this->render('fechado',[
      'bolao'=>$bolao,
      'listaCompleta'=>(bool)$listaCompleta,
    ]);
  }

  public function actionRanking($id){
    $bolao = $this->getBolao($id);
    $this->setMenuLateral($bolao);
    $this->render('ranking',['bolao'=>$bolao]);
  }

  public function actionEstatistica($id){
    $bolao = $this->getBolao($id);
    $this->setMenuLateral($bolao);
    $this->render('estatistica',[
      'bolao'=>$bolao,
      'pontosPorRodada'=>$this->pontosPorRodada($bolao),
      'resultados'=>$bolao->campeonato->getPlacares(),
      'palpites'=>$bolao->getPalpites(),
    ]);
  }

  private function pontosPorRodada($bolao){
    $data = Yii::app()->db->createCommand()
      ->select('j.rodada,sum(p.pontos) as soma')
      ->from('palpite p')
      ->join('jogo j','j.idJogo = p.idJogo')
      ->where('p.idBolao = ' . $bolao->idBolao)
      ->group('j.rodada')
      ->having('sum(p.pontos) > 0')
      ->queryAll();
    $formatedData = array_map(function($i){
      return [$i['rodada'],(int)$i['soma']];
    }, $data);
    return json_encode(array_merge([['Rodadas','Pontos']],$formatedData));
  }


  public function actionInscricaoPaga($id){
    $bolao = Bolao::model()->findByPk((int)$id);
    if(!is_null($bolao) && $bolao->tipoInscricao == Bolao::TipoPago){
      $userBolao = new UserBolao();
      $userBolao->idUsuario = $this->user->id;
      $userBolao->idBolao = (int)$id;
      $userBolao->dataInscricao = time();
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
      $userBolao->dataInscricao = time();
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
      if(time() >= $fechamento){
        echo 'Apostas do dia encerradas.';
      } else {
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

  public function actionTabelaBrasileirao(){
    $this->renderPartial('/bolao/_iframeTabelaBrasileirao');
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
    return in_array($bolao->idBolao,array_keys($this->getBoloesInscritos()));
  }

  public function getBoloesInscritos(){
    if(is_null($this->boloesInscritos)){
      $this->boloesInscritos = $this->user->boloesInscritos; 
    }
    return $this->boloesInscritos;
  }

}
