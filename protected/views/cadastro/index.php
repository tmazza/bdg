<div class="card-panel" style="max-width:400px;margin:0 auto;">
  <div class="uk-align-center" style="width:230px;">
    <br><br>
    <?php $this->widget('ext.eauth.EAuthWidget', array('action' => '/site/login')); ?>
  </div>
</div>
<br>
<div class="card-panel" style="max-width:400px;margin:0 auto;">
  <?php $this->renderPartial('_cadastroForm', ['model' => $model]); ?>
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
<?=CHtml::link('Já tem cadastro?', $this->createUrl('/site/login'));?>
