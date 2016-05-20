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
      $campeonato = $this->getCampeonato($id);

      if(isset($_POST['dia'])){
        $this->proecessaRodada($campeonato);
      }

      $this->render('rodadas',[
        'campeonato'=>$campeonato,
        'dias'=>$campeonato->jogosPorDiaFechados(),
      ]);
    }

    /**
     * Para cada bolão | para usuario | para cada jogo -> atualiza palpite | atualiza ranking
     */
    private function proecessaRodada($campeonato){
      $dia = (int) $_POST['dia'];

      $jogosNoDia = $campeonato->jogosNesteDiaNaoProcessados($dia);
      $boloes = $campeonato->boloes;

      $transaction = Yii::app()->db->beginTransaction();
      $ok = true;
      foreach ($boloes as $b) {
        $participantes = $b->participantes;
        echo count($participantes) . '-';
        $pontuacao = []; # Valor que deve ser somado à pontuação de um $user

        foreach ($participantes as $u) {
          $pontuacao[$u->id] = [
            'pontos'=>0,
            'exato'=>0,
            'vencedor'=>0,
          ];
          foreach ($jogosNoDia as $j) {
            list($palpite,$pontos) = $j->calculaPontos($b,$u);
            if($palpite){
              $palpite->pontos = $pontos;
              $ok = $ok && $palpite->update(['pontos']);
              $pontuacao[$u->id]['pontos']+=$pontos;
              if($pontos == Jogo::PExato)
                $pontuacao[$u->id]['exato']++;
              if($pontos == Jogo::PVencedor || $pontos == Jogo::PVencedorEGols)
                $pontuacao[$u->id]['vencedor']++;
            }
          }
        }
        $ok = $ok && $this->atualizaRanking($pontuacao,$b);
      }

      foreach ($jogosNoDia as $j) {
        $j->status = Jogo::StatusFechado;
        $ok = $ok && $j->update(['status']);
      }

      if($ok){
        echo 'OK';
        exit;

        HView::fsuc('Ranking atualizado. ' . count($jogosNoDia) . ' jogos processados.');
        // $transaction->commit();
      } else {
        HView::ferr('Erro ao atualizar.');
        $transaction->rollback();
      }

    }

    private function atualizaRanking($pontuacao,$bolao){
      $ok = true;
      foreach ($pontuacao as $userId => $pontuacao) {
        $model = Ranking::model()->findByPk([
          'idBolao'=>$bolao->idBolao,
          'idUsuario'=>$userId
        ]);
        if(is_null($model)){
          $model = new Ranking();
          $model->idBolao = $bolao->idBolao;
          $model->idUsuario = $userId;
          $model->qtdExatos = 0;
          $model->qtdVencedores = 0;
          $model->pontos = 0;
        }
        $model->pontos += $pontuacao['pontos'];
        $model->qtdExatos += $pontuacao['exato'];
        $model->qtdVencedores += $pontuacao['vencedor'];
        if($model->isNewRecord){
          $ok = $ok && $model->save();
        } else {
          $ok = $ok && $model->update(['pontos','qtdExatos','qtdVencedores']);
        }
      }
      return $ok;
    }

    private function getCampeonato($id){
      $campeonato = Campeonato::model()->findByPk(substr($id,0,5));
      if(is_null($campeonato)){
        HView::ferr("Campeonato não encontrado");
        $this->redirect($this->createUrl('/editor/dafault/index'));
      }
      return $campeonato;
    }


}
