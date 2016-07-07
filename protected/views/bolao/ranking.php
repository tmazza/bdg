<?php
$this->renderPartial('_headerBolao',['bolao'=>$bolao]);
$posicoes = $bolao->posicoes;
$algumPendente = false;
?>
<?php if(count($posicoes)>0):?>
  <table class="uk-table uk-table-condensed uk-table-striped">
    <tr>
      <th>#</th>
      <th></th>
      <th class="uk-text-right" data-uk-tooltip title="Quantidade de acertos no placar exato da partida">
        <span class="uk-hidden-small">Placar exato</span>
        <span class="uk-visible-small"><i class="uk-icon uk-icon-info-circle"></i></span>
      </th>
      <th class="uk-text-right" data-uk-tooltip title="Quantidade de acertos de qual o time vencedor da partida <small>(Sem considerar acertos exatos de placar)</small>.">
        <span class="uk-hidden-small">Vencedor do jogo</span>
        <span class="uk-visible-small"><i class="uk-icon uk-icon-info-circle"></i></span>
      </th>
      <th class="uk-text-right">Pontos</th>
    </tr>
    <?php $count = 0; ?>
    <?php foreach ($posicoes as $p): ?>
      <?php $count++; ?>
      <?php
      $pendente =  $bolao->isInscricaoPendente($p->user->id);
      $algumPendente = $pendente || $algumPendente;
      ?>
      <tr class="<?=$pendente ? 'pendente' : ''?>">
        <td><?=$count?>º</td>
        <td>
          <?php 
          if($p->user->id != $this->user->id && $p->user->isOnline())
            $this->renderPartial('_userOnline');
          ?>
          <?=CHtml::encode(ucfirst($p->user->nome))?>
        </td>
        <td class="uk-text-right"><?=$p->qtdExatos?></td>
        <td class="uk-text-right"><?=$p->qtdVencedores?></td>
        <td class="uk-text-right"><b><?=$p->pontos?></b></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <?php if($algumPendente):?>
    <span class="uk-badge pendente uk-margin uk-text-danger">Legenda: Inscrição não confirmada.</span>
  <?php endif;?>
<?php else: ?>
  <br>
  <div class="uk-alert">
    Nenhum resultado.
  </div>
<?php endif; ?>
