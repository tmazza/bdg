<h3>Complemento de cadastro</h3>
<div class="">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'dados-adicionais-form-asdasd-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>[
      'class'=>'uk-form',
    ]
)); ?>

    <div class="uk-form-row">
        <?=$form->labelEx($model,'email',['class'=>'uk-form-label']); ?>
        <div class="uk-form-controls">
          <?=$form->textField($model,'email',['']); ?>
        </div>
        <?=$form->error($model,'email'); ?>
    </div>

    <div class="uk-form-row">
        <?=$form->labelEx($model,'time',['class'=>'uk-form-label']); ?>
        <div class="uk-form-controls">
          <?=$form->textField($model,'time',['']); ?>
        </div>
        <?=$form->error($model,'time'); ?>
    </div>
    <br>
    <?=CHtml::submitButton('Salvar',[
      'class'=>'uk-button uk-button-primary uk-form-stacked',
      'style'=>'color:white',
    ]); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->
