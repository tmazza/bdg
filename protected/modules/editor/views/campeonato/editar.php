<div class="uk-form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'campeonato-_form-form',
    'enableAjaxValidation'=>false,
)); ?>
    <div class="uk-row">
        <?php echo $form->labelEx($model,'codigo'); ?>
        <?php echo $form->textField($model,'codigo'); ?>
        <?php echo $form->error($model,'codigo'); ?>
    </div>

    <div class="uk-row">
        <?php echo $form->labelEx($model,'nome'); ?>
        <?php echo $form->textField($model,'nome'); ?>
        <?php echo $form->error($model,'nome'); ?>
    </div>

    <div class="uk-row">
        <?php echo $form->labelEx($model,'inicio'); ?>
        <?php echo $form->textField($model,'inicio'); ?>
        <?php echo $form->error($model,'inicio'); ?>
    </div>

    <div class="uk-row">
        <?php echo $form->labelEx($model,'fim'); ?>
        <?php echo $form->textField($model,'fim'); ?>
        <?php echo $form->error($model,'fim'); ?>
    </div>

    <div class="uk-row">
        <?php echo $form->labelEx($model,'situacao'); ?>
        <?php echo $form->textField($model,'situacao'); ?>
        <?php echo $form->error($model,'situacao'); ?>
    </div>


    <div class="uk-row buttons">
        <?php echo CHtml::submitButton('Atualizar',['class'=>'uk-button']); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
