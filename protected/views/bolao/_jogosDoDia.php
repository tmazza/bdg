<?php
$hoje = mktime(0,0,0,date('m'),date('d'),date('Y'));
?>
<div class="uk-panel uk-panel-box" >
  <h4>
    <?=date('d/m/Y',$dia);?>
    <?php if($dia<$hoje): ?>
      - Finalizado
      <a href="#!" class="uk-button" onclick="$(this).parent().next().slideToggle();" />Ver</a>
    <?php endif; ?>
  </h4>
  <div <?=($dia<$hoje)?'style="display:none;"':'';?>>
    <hr>
    <?php foreach ($jogos as $j): ?>
      <?=substr($j->data,11,5)?>
      <span data-uk-tooltip title="<?=$j->mandante->nome;?>">
        <?=$j->mandante->imagemBrasao('P')?>
      </span>
      <input style="width:20px;" <?=($dia<$hoje)?'disabled':'';?>/>
      x
      <input style="width:20px;" <?=($dia<$hoje)?'disabled':'';?>/>
      <span data-uk-tooltip title="<?=$j->visitante->nome;?>">
        <?=$j->visitante->imagemBrasao('P')?>
      </span>
      <br>
    <?php endforeach; ?>
  </div>
</div>
<br>
