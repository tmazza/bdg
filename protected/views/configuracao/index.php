<h3>Recebimento de notificações</h3>
<small>Selecione as notificações que deseja receber</small><br><br>
<div class="uk-form">
	<?php $form=$this->beginWidget('CActiveForm', array(
	    'id'=>'configuracao-ad-form',
	    'enableAjaxValidation'=>false,
	)); ?>
	<ul class="uk-list uk-list-line">
		<li>
		    <?= $form->checkbox($model,'emailFechaDia'); ?>
		    <?= $form->labelEx($model,'emailFechaDia'); ?>
		    <?= $form->error($model,'emailFechaDia'); ?>
		</li>
		<!-- <li>
		    <?//= $form->checkbox($model,'emailAvisoFechaDia'); ?>
		    <?//= $form->labelEx($model,'emailAvisoFechaDia'); ?>
		    <?//= $form->error($model,'emailAvisoFechaDia'); ?>
		</li> -->
		<li>
		    <?= $form->checkbox($model,'faceAvisoFechaDia'); ?>
		    <?= $form->labelEx($model,'faceAvisoFechaDia'); ?>
		    <?= $form->error($model,'faceAvisoFechaDia'); ?>
		</li>
	</ul>

    <div class="row buttons">
        <?= CHtml::submitButton('Atualizar',[
        	'class'=>'uk-button uk-button-primary',
        	'style' => 'color:white',
        ]); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->