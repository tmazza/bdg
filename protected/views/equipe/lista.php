<?php foreach ($equipes as $e): ?>
  <div class="uk-panel uk-panel-box uk-animation-fade" >
    <?=$e->imagemBrasao('M',['style'=>'margin:12px;']);?> <?=$e->abreviacao;?> | <?=$e->nome;?>
  </div>
<?php endforeach; ?>
