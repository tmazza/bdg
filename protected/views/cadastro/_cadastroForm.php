<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'cadastro-form-asd-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array(
      'class' => 'uk-form uk-form-stacked'
    ),
));
?>
    <b>Criar uma conta</b>
    <div class="uk-grid">
      <div class="uk-width-small-1-1">
        <?php echo $form->labelEx($model,'nome'); ?>
        <?php echo $form->textField($model,'nome',array('class'=>'uk-width-1-1')); ?>
        <?php echo $form->error($model,'nome'); ?>
      </div>
      <div class="uk-width-small-1-1">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->emailField($model,'email',array('class'=>'uk-width-1-1')); ?>
        <?php echo $form->error($model,'email'); ?>
      </div>
      <div class="uk-width-small-1-1 uk-width-medium-1-2">
        <?php echo $form->labelEx($model,'senha'); ?>
        <?php echo $form->passwordField($model,'senha',array('class'=>'uk-width-1-1')); ?>
        <?php echo $form->error($model,'senha'); ?>
      </div>
      <div class="uk-width-small-1-1 uk-width-medium-1-2">
        <?php echo $form->labelEx($model,'senhaConfirma'); ?>
        <?php echo $form->passwordField($model,'senhaConfirma',array('class'=>'uk-width-1-1')); ?>
        <?php echo $form->error($model,'senhaConfirma'); ?>
      </div>
    </div>
    <br>
    <div class="">
      <?php echo CHtml::submitButton('Criar', array('class'=>'uk-button uk-button-primary','style'=>'color:white;')); ?>
    </div>
<?php $this->endWidget(); ?>
