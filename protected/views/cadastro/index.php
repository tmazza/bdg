<div class="uk-container uk-container-center" style="max-width: 400px;">
  <div class="md-card">
    <br><br>
    <?php
    $this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login')); 
    ?>
    <br><br>
    <div class="card-panel" style="max-width:400px;margin:0 auto;">
      <div style="background: #f2f2f2; padding: 12px;border-radius: 12px;">
        <?php $this->renderPartial('_cadastroForm', ['model' => $model]); ?>
      </div>
    </div>
    <div id="cadastro-rec-senha"  class="uk-modal uk-animation-scale">
      <div class="uk-modal-dialog">
          <a class="uk-modal-close uk-close"></a>
          <div class="content">
            <?php $this->renderPartial('/site/recuperarSenha');?>
          </div>
      </div>
    </div>
    
    <br>
    <br>
    <hr>
    <?=CHtml::link('Já tem cadastro?', $this->createUrl('/site/login'), [
      'style'=>'width:100%',
      'class'=>'uk-button uk-button-link',
    ]);?>
  </div>
</div>


<style>
  html {
    height: 100%!important;    
    background-image: linear-gradient(315deg, #0093E9 0%, #80D0C7 100%)!important;
  }
</style>