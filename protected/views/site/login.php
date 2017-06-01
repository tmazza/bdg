<div class="uk-grid">
  <div class="uk-width-medium-1-2 uk-width-small-1-1">
    <div class="uk-align-center" style="width:230px;">
      <br><br>
      <?php $this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login')); ?>
      <br><br>
      <?= CHtml::link('Criar uma conta', $this->createUrl('/cadastro/index'),array('class'=>'uk-button uk-button-link','style'=>'width:100%')); ?>
      <?= CHtml::link('Entrar usando email', '#!',array('class'=>'uk-button uk-button-link','style'=>'width:100%','onclick'=>'$(this).next().slideToggle()')); ?>
      <div style="display:none;">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => [
              'class'=>'uk-form uk-form-stacked'
            ],
        ));
        ?>
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('tabindex'=>1)); ?>
        <?php echo $form->error($model, 'username'); ?>
        <br>
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('tabindex'=>2)); ?>
        <?php echo $form->error($model, 'password'); ?>
        <?= CHtml::link('Recuperar senha', '#modal2', array('data-uk-modal' => '')); ?>
        <br>
        <br>
        <?php echo CHtml::submitButton('Entrar', array(
          'class' => 'uk-button uk-button-primary',
          'style' => 'color:white;',
          'tabindex'=>3)); ?>
        <?php $this->endWidget(); ?>
      </div>
    </div>
  </div>
  <div class="uk-width-medium-1-2 uk-width-small-1-1">
    <div class="uk-hidden-small">
      <div style="background: url('<?=$this->assetsDir;?>/images/login-side.jpg'); background-size: cover;box-shadow: 0 0 5px 5px white inset;width: 100%;height: 500px;" ></div>

    </div>
  </div>
</div>
<div id="modal2" class="uk-modal">
  <div class="uk-modal-dialog">
    <a class="uk-modal-close uk-close"></a>
    <?php $this->renderPartial('/site/recuperarSenha');?>
  </div>
</div>
