<?php $this->beginContent('application.views.layouts.base'); ?>
<div class="uk-container uk-container-center">
  <?php HView::flashMessages(); ?>
  <div class="uk-text-right">
    <?php if($this->user): ?>
      <?=$this->user->nome;?>
      (<?=CHtml::link('Sair',$this->createUrl('/site/logout'));?>)
    <?php endif; ?>
  </div>
  <div class="uk-grid">
    <div class='uk-width-7-10'>
      <?=$content?>
    </div>
    <div class='uk-width-3-10'>
      <ul class="uk-tab uk-tab-right uk-width-medium-1-2" >
        <?php foreach ($this->menuLateral as $i) {
          echo '<li ' . ($i[0]==$this->action->id?'class="uk-active"':'') . '>';
          echo CHtml::link($i[1],$i[2],isset($i[3])?$i[3]:[]);
          echo '</li>';
        } ?>
      </ul>
    </div>
  </div>
</div>
<?php $this->endContent(); ?>
