<?php $this->beginContent('application.views.layouts.base'); ?>
<div class="uk-container uk-container-center">
  <?php HView::flashMessages(); ?>
  <div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-text-right">
      <?php if($this->user): ?>
        <?=$this->user->nome;?>
        (<?=CHtml::link('Sair',$this->createUrl('/site/logout'));?>)
      <?php else: ?>
        <!-- <?//=CHtml::link('Minha conta',$this->createUrl('/site/login'));?> -->
      <?php endif; ?>
    </div>
    <?=$content;?>
  </div>
</div>
<?php $this->endContent(); ?>
