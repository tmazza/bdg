<div class="" style="max-width:400px;margin:0 auto;">
  <?php $this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login')); ?>
</div>
<div class="card-panel" style="max-width:400px;margin:0 auto;">
  <div class="right">
    <?= CHtml::link('Cadastre-se', $this->createUrl('/cadastro/index'),array('class'=>'right')); ?>
  </div>
  <div class="flow-text">Login</div>
  <br>
  <?php
  $form = $this->beginWidget('CActiveForm', array(
      'id' => 'login-form',
      'enableClientValidation' => true,
      'clientOptions' => array(
          'validateOnSubmit' => true,
      ),
  ));
  ?>
  <?php echo $form->labelEx($model, 'username'); ?>
  <?php echo $form->textField($model, 'username', array('tabindex'=>1)); ?>
  <?php echo $form->error($model, 'username'); ?>
  <?= CHtml::link('Recuperar senha', '#modal2', array('class' => 'modal-trigger')); ?>
  <br>
  <?php echo $form->labelEx($model, 'password'); ?>
  <?php echo $form->passwordField($model, 'password', array('tabindex'=>2)); ?>
  <?php echo $form->error($model, 'password'); ?>
  <br><br>
  <br>
  <?php echo CHtml::submitButton('Entrar', array('class' => 'btn indigo right','tabindex'=>3)); ?>
  <?php $this->endWidget(); ?>
</div>
<br><br><br>
<div id="modal2" class="modal">
  <?php $this->renderPartial('/site/recuperarSenha');?>
</div>
