<?php
$this->renderPartial('_headerBolao',['bolao'=>$bolao]);
?>
<table class="uk-table uk-table-condensed uk-table-striped">
  <tr>
    <th></th>
    <th>Qtd. Acertos placar exato</th>
    <th data-uk-tooltip title="Sem considerar acertos de placar exato">Qtd. Acertor vencedor do jogo</th>
    <th>Pontos</th>
  </tr>
  <?php foreach ($bolao->posicoes as $p): ?>
    <tr>
      <td><?=$p->user->nome?></td>
      <td><?=$p->qtdExatos?></td>
      <td><?=$p->qtdVencedores?></td>
      <td><?=$p->pontos?></td>
    </tr>
  <?php endforeach; ?>
</table>
