<?php if($qtdOutros>0): ?>
  <?php if($qtdInscritos>0): ?>
    <div class="uk-alert">
      Existe<?=HView::hasPlural($qtdOutros,'m')?> mais <?=$qtdOutros?> oportunidade<?=HView::hasPlural($qtdOutros)?>
      de ganhar.
      <?=CHtml::link('Participe <b>\</b>o<b>/</b>','#!',[
        'class'=>'uk-button uk-button-success',
        'onClick'=>'$("#outros-boloes").slideDown(0);',
      ])?>
    </div>
    <div id='outros-boloes' style="display:none;" class="uk-animation-fade uk-panel uk-panel-box">
      <a href="#!" class="uk-close uk-close-alt uk-float-right" onclick="$(this).parent().slideUp();"></a>
      <?php $this->renderPartial('_outrosBoloes',['boloes'=>$outrosBoloes]); ?>
    </div>
    <br>
  <?php else: ?>
    <?php $this->renderPartial('_outrosBoloes',['boloes'=>$outrosBoloes]); ?>
  <?php endif; ?>
<?php endif; ?>
<?php
  if($qtdInscritos == 1){
    $b = array_shift($boloesInscritos);
    $this->renderPartial('_bolaoInscrito',[
      'bolao'=>$b,
      'aberto'=>true,
    ]);
  } else {
    $first=true;
    foreach ($this->user->boloesInscritos as $b) {
      $this->renderPartial('_bolaoInscrito',[
        'bolao'=>$b,
        'aberto'=>$first,
      ]);
      $first=false;
    }
  }
?>
