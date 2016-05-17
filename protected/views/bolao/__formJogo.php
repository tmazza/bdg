<div id='dia-<?=$dia?>'>
  <?php foreach ($jogos as $j): ?>
    <?php
    list($golsMandante,$golsVisitante) = $j->getGolsPalpiteUserBolao($bolao);
    ?>

    <?=substr($j->data,11,5)?>
    <span data-uk-tooltip title="<?=$j->mandante->nome;?>">
      <?=$j->mandante->imagemBrasao('P')?>
    </span>
    <input value="<?=$golsMandante?>" name='<?=$j->idJogo?>[casa]' style="width:20px;" numerical />
    x
    <input value="<?=$golsVisitante?>" name='<?=$j->idJogo?>[visi]' style="width:20px;" numerical />
    <span data-uk-tooltip title="<?=$j->visitante->nome;?>">
      <?=$j->visitante->imagemBrasao('P')?>
    </span>
    <br>
  <?php endforeach; ?>
</div>
