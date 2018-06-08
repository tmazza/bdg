<!DOCTYPE html>
<html lang='pt'>
    <?php $this->renderPartial('//layouts/head'); ?>
    <body>
      <div id='header'>
        <div class="uk-container uk-container-center">
          <?php if($this->centerLogo): ?>
            <div class="uk-text-center" style="margin-top: 100px;">
              <a href="<?=$this->createUrl('/site/index')?>" class="" style="padding:10px 2px;">
                <?=CHtml::image($this->assetsDir.'/images/logo.png','Bolão do Gordo',['style'=>'width:140px;']);?>
              </a>
            </div>
          <?php else: ?>
            <a href="<?=$this->createUrl('/site/index')?>" class="" style="padding:10px 2px;">
              <?=CHtml::image($this->assetsDir.'/images/logo-single.png','Bolão do Gordo',['style'=>'width:80px;']);?>
            </a>
          <?php endif; ?>
          <div class="uk-float-right uk-margin-top">
            <?php if($this->user): ?>
              <div class="uk-button-dropdown" data-uk-dropdown="">
                  <button class="uk-button">
                    <?=$this->user->nome;?> <i class="uk-icon-caret-down"></i>
                  </button>
                  <div style="top:30px;left:0px;" class="uk-dropdown uk-dropdown-small uk-dropdown-bottom">
                      <ul class="uk-nav uk-nav-dropdown">
                          <li>
                            <?=CHtml::link('<i class="uk-icon uk-icon-cog"></i> Configurações',$this->createUrl('/configuracao/index'));?>
                          </li>
                          <li class="uk-nav-divider"></li>
                          <li>
                            <?=CHtml::link('Sair',$this->createUrl('/site/logout'));?>
                          </li>
                      </ul>
                  </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <?=$content;?>
      
      <?php
      if($this->centerLogo) {
        $this->renderPartial('//layouts/_addsFooter');
      } else {
        $this->renderPartial('//layouts/footer'); 
      }
      ?>
      
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

  </body>
</html>
