<?php HView::flashMessages(); ?>
<div class="uk-container uk-container-center" style="max-width: 400px;">
  <div class="md-card">
    <br><br>
    <?php
    $this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login')); 
    ?>
    <br><br>

    <div style="background: #f2f2f2; padding: 12px;border-radius: 12px;">
      <b>Entrar usando email</b>
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
      <?php echo $form->labelEx($model, 'username', [
        'style' => 'width:70px;display:inline-block;'
      ]); ?>
      <?php echo $form->textField($model, 'username', array('tabindex'=>1)); ?>
      <?php echo $form->error($model, 'username'); ?>
      <br>
      <?php echo $form->labelEx($model, 'password', [
        'style' => 'width:70px;display:inline-block;'
      ]); ?>
      <?php echo $form->passwordField($model, 'password', array('tabindex'=>2)); ?>
      <?php echo $form->error($model, 'password'); ?>
      <br>
      <?= CHtml::link('Não lembra a senha?', '#modal2', array('data-uk-modal' => '')); ?>
      
      <br>
      <br>
      <?php echo CHtml::submitButton('Entrar', array(
        'class' => 'uk-button uk-button-primary',
        'style' => 'color:white;',
        'tabindex'=>3)); ?>
      <?php $this->endWidget(); ?>
    </div>

    <br>
    <br>
    <hr>
    <?= CHtml::link('Primeiro acesso?', $this->createUrl('/cadastro/index'),array(
        'class'=>'uk-button uk-button-link',
        'style'=>'width:100%',
        )); ?>


  </div>
</div>

<div id="modal2" class="uk-modal">
  <div class="uk-modal-dialog">
    <a class="uk-modal-close uk-close"></a>
    <?php $this->renderPartial('/site/recuperarSenha');?>
  </div>
</div>

<style>
  html {
    height: 100%!important;    
    background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%)!important;
  }
</style>