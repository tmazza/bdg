<?php $this->beginContent('application.views.layouts.base'); ?>
<div class="uk-container uk-container-center">
  <?php HView::flashMessages(); ?>
  <div class="md-card">
    <div class="uk-grid">
      <div class='uk-width-small-1-1 uk-visible-small'>
        <ul class="uk-tab uk-tab-right uk-width-medium-1-2" >
          <?php foreach ($this->menuLateral as $i) {
            echo '<li ' . ($i[0]==$this->action->id?'class="uk-active"':'') . '>';
            echo CHtml::link($i[1],$i[2],isset($i[3])?$i[3]:[]);
            echo '</li>';
          } ?>
        </ul>
        <br>
      </div>
      <div class='uk-width-medium-7-10 uk-width-small-1-1'>
          <?=$content?>
      </div>
      <div class='uk-width-medium-3-10 uk-hidden-small'>
        <ul class="uk-tab uk-tab-right uk-width-medium-1-2" >
          <?php foreach ($this->menuLateral as $i) {
            echo '<li ' . ($i[0]==$this->action->id?'class="uk-active"':'') . '>';
            echo CHtml::link($i[1],$i[2],isset($i[3])?$i[3]:[]);
            echo '</li>';
          } ?>
        </ul>
        <?php if($this->tabelaBrasileirao): ?>
          <br><br><hr><br>
          <?php
          echo CHtml::ajaxLink('Ver tabela do Brasileirão',$this->createUrl('/bolao/loadTabBra'),[
            'success'=>'js:function(html){ $("#ver-tabela").html(html); }',
          ],[
            'onclick'=>'$(this).slideUp();',
            'class'=>'uk-hidden-small uk-button',
          ]);
          ?>
          <div id='ver-tabela' data-uk-sticky="{top:5,boundary: true}"></div>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
<?php $this->endContent(); ?>
