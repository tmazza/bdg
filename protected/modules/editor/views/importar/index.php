<div class="uk-grid">
  <div class="uk-width-2-3">
    <?php if(count($jogos) > 0): ?>
      <?php
      $this->renderPartial('_listaDeJogos',[
          'jogos'=>$jogos,
          'equipes'=>$equipes,
          'campeonatos'=>$campeonatos,
      ]);
      ?>
    <?php endif; ?>
    <?=CHtml::beginForm('','POST',['class'=>'uk-form']);?>
      <div class="uk-form-row">
        <div class="uk-alert">
          <ul>
            <li>Variáveis obrigatórias: <code>DATA</code>,<code>HORA</code>,<code>CASA</code>,<code>VISITANTE</code></li>
            <li>Opcionais: <code>NUM</code> (se não informado será utilzado o número da linha), <code>RODADA</code></li>
            <li>Descartar colunas: <code>-</code></li>
            <br>
            <li>Formato para data d/m. Formato para hora H:i</li>
          </ul>
        </div>
        <?= CHtml::activeLabel($model,'formato'); ?>
        <?= CHtml::activeTextField($model,'formato',['class'=>'uk-width-1-1']) ?>
        <?= CHtml::error($model,'formato') ?>
      </div>
      <div class="uk-form-row">
        <?= CHtml::activeTextArea($model,'jogos',[
          'class'=>'uk-width-1-1',
          'style'=>'min-height:400px;',
        ]) ?>
        <?= CHtml::error($model,'jogos') ?>
      </div>
      <br>
      <button type="submit" class="uk-button uk-button-primary">Processar</button>
    <?=CHtml::endForm();?>
  </div>
  <div class="uk-width-1-3">
    <ul class="uk-nav uk-margin-top uk-margin-bottom">
      <li class="uk-nav-header">Equipes</li>
      <?php foreach ($equipes as $e): ?>
        <li><?=$e->imagemBrasao('PP')?> <?=$e->nome?></li>
      <?php endforeach; ?>
    </ul>
    <small class="uk-alert uk-alert-danger">Utilize nomes exatamente iguais aos da tabela abaixo</small>
  </div>
</div>
