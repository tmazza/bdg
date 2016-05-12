<?php if(count($jogos) > 0): ?>
  <h3>Jogos identificados</h3>
  <table class="uk-table">
    <tr><th>Data</th><th>Hora</th><th>Casa</th><th>Visitante</th></tr>
    <?php foreach ($jogos as $j): ?>
      <tr><td><?=$j['DATA']?></td><td><?=$j['HORA']?></td><td><?=$j['CASA']?></td><td><?=$j['VISITANTE']?></td></tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>

<?=CHtml::beginForm('','POST',['class'=>'uk-form']);?>
  <div class="uk-form-row">
    <?= CHtml::activeLabel($model,'formato'); ?>
    <?= CHtml::activeTextField($model,'formato',['class'=>'uk-width-1-1']) ?>
    <?= CHtml::error($model,'formato') ?>
  </div>
  <div class="uk-form-row">
    <?= CHtml::activeLabel($model,'jogos'); ?>
    <?= CHtml::activeTextArea($model,'jogos',[
      'class'=>'uk-width-1-1',
      'style'=>'min-height:400px;',
    ]) ?>
    <?= CHtml::error($model,'jogos') ?>
  </div>
  <br>
  <button type="submit" class="uk-button uk-button-primary">Processar</button>
<?=CHtml::endForm();?>
