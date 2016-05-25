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
    <div class="uk-visible-small"><hr></div>
Estão abertas as inscrições para o Bolão do Gordo 2016!<br/>
São dois bolões disponíveis: O bolão gratuito não tem taxa de inscrição, e o primeiro colocado ganha R$50,00. O bolão pago tem taxa de R$30,00 e os 3 primeiros colocados recebem prêmios em dinheiro.<br/>
Maiores informações no regulamento de cada bolão.<br/>
<b>Atenção</b>, o bolão inicia na 4ª rodada do Brasileirão, dia 28/05    
  </div>
</div>
<div id="modal2" class="uk-modal">
  <div class="uk-modal-dialog">
    <a class="uk-modal-close uk-close"></a>
    <?php $this->renderPartial('/site/recuperarSenha');?>
  </div>
</div>
