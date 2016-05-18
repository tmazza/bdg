<!DOCTYPE html>
<html lang='pt' style="background:#dedede;">
    <?php $this->renderPartial('//layouts/head'); ?>
    <body>
      <div id='header'>
        <div class="uk-container uk-container-center">
          <a href="<?=$this->createUrl('/site/index')?>" class="" style="padding:10px 2px;">
            <?=CHtml::image($this->assetsDir.'/images/logo-2.png','Bolão do Gordo',['style'=>'width:140px;']);?>
          </a>
          <div class="uk-float-right uk-margin-top">
            <?php if($this->user): ?>
              <?=$this->user->nome;?>
              (<?=CHtml::link('Sair',$this->createUrl('/site/logout'));?>)
            <?php else: ?>
              <!-- <?//=CHtml::link('Minha conta',$this->createUrl('/site/login'));?> -->
            <?php endif; ?>
          </div>
        </div>
      </div>

      <?=$content;?>

      <?php $this->renderPartial('//layouts/footer'); ?>

      <!-- modal ajax multi uso :) -->
      <div id="main-modal" class="uk-modal uk-animation-scale">
        <div class="uk-modal-dialog">
          <a class="uk-modal-close uk-close"></a>
          <div class="content"><div class="uk-modal-spinner"></div></div>
        </div>
      </div>
      <div id="main-modal-large" class="uk-modal uk-animation-scale-up">
        <div class="uk-modal-dialog uk-modal-dialog-large">
          <a class="uk-modal-close uk-close"></a>
          <div class="content"><div class="uk-modal-spinner"></div></div>
        </div>
      </div>

  </body>
</html>
