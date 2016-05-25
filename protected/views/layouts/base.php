<!DOCTYPE html>
<html lang='pt' style="background:#dedede;">
    <?php $this->renderPartial('//layouts/head'); ?>
    <body>
			<?php if(!YII_DEBUG): ?>
			<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-31889911-1', 'auto');
			ga('send', 'pageview');
			</script>
			<?php endif; ?>

      <div id='header'>
        <div class="uk-container uk-container-center">
          <a href="<?=$this->createUrl('/site/index')?>" class="" style="padding:10px 2px;">
            <?=CHtml::image($this->assetsDir.'/images/logo.png','Bolão do Gordo',['style'=>'width:140px;']);?>
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
