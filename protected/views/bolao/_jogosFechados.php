<div class="uk-panel uk-panel-box" >
  <h4><?=date('d/m/Y',$dia);?></h4>
  <div>
    <hr>
    <?php foreach ($jogos as $j): ?>
      <?=substr($j->data,11,5)?>
      <span data-uk-tooltip title="<?=$j->mandante->nome;?>">
        <?=$j->mandante->imagemBrasao('P')?>
      </span>
      <?=$j->golsMandante;?>
      x
      <?=$j->golsVisitante;?>
      <span data-uk-tooltip title="<?=$j->visitante->nome;?>">
        <?=$j->visitante->imagemBrasao('P')?>
      </span>
      <br>
    <?php endforeach; ?>
  </div>
</div>
<br>
