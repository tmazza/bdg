<?php echo CHtml::beginForm($this->createUrl('/senha/recuperar')); ?>
  <div class="uk-modal-header">
    <h3>Recuperar senha</h3>
  </div>
  <p>
  Seu email:
  <input type='email' name='email' required="true" />
  </p>
  <div class="uk-modal-footer uk-text-right">
    <button type='submit' class="uk-button uk-button-primary">Solicitar</button>
  </div>
<?php echo CHtml::endForm(); ?>
