<h3>Alteração de senha</h3>
<div class="md-card">
  <?php
  $form=$this->beginWidget('CActiveForm', array(
      'id'=>'alterar-senha-form-asdad-form',
      'enableAjaxValidation'=>false,
      'action' => $this->createUrl('/senha/alterar',array('h'=>$h)),
  ));
  ?>
  <div class="uk-alert uk-alert-warning">
    Email: <b><?=$user->email;?></b>
  </div>
  <ul>
    <li>Senha deve ter no mínimo <b>6</b> caracteres.</li>
  </ul>
  <div class="uk-grid">
    <div class="uk-width-medium-1-3 uk-width-small-1-1 uk-text-center-small">
      <?= $form->labelEx($model,'senha'); ?><br>
      <?= $form->passwordField($model,'senha'); ?>
      <?= $form->error($model,'senha'); ?>
    </div>
    <div class="uk-width-medium-1-3 uk-width-small-1-1 uk-text-center-small">
      <?= $form->labelEx($model,'senhaConfirma'); ?><br>
      <?= $form->passwordField($model,'senhaConfirma'); ?>
      <?= $form->error($model,'senhaConfirma'); ?>
    </div>
    <div class="uk-width-medium-1-3 uk-width-small-1-1 uk-text-right">
      <br>
      <?= CHtml::submitButton('Alterar',['class'=>'uk-button uk-button-primary']); ?>
    </div>
  </div>

  <?php $this->endWidget(); ?>
</div>
