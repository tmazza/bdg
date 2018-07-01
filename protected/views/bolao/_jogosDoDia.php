<?php
$fechamento = $bolao->getHoraFechamento($jogos);
?>
<div class="uk-panel uk-panel-box" style="padding: 10px;max-width: 450px;box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.12), 0px 1px 2px rgba(0, 0, 0, 0.24) !important;background: #ffffff;margin:0 auto;border-radius: 0px;">
  <h4 style="margin-bottom: 0px;">
    <b><?=HView::tradDia(date('l, d/m',$dia));?></b>
  </h4>
  <small>
    <div data-uk-tooltip='' title='Após este horário você não poderá salvar os palpites do dia.'>
      Fecha às <?=HView::tradDia(date('H:i \d\e l',$fechamento-1))?>
    </div>
  </small>
  <br>
  <div>
    <?=CHtml::beginForm('','POST',['id'=>'form-'.$dia,'class'=>'uk-form']);?>
      <input type='hidden' name='dia' value='<?=$dia?>' />
      <input type='hidden' name='bolao' value='<?=$bolao->idBolao?>' />
      <?php
      $this->renderPartial('__formJogo',[
        'jogos'=>$jogos,
        'dia'=>$dia,
        'bolao'=>$bolao,
      ]);
      ?>
      <br>
      <?php
      echo CHtml::link('Atualizar palpite', '#!', [
        'onclick' => "return salvaPalpite('{$dia}');",
        'class' => 'uk-button uk-button-success',
        'style' => 'color:white;',
        'type' => 'text',
      ]);?>
      <div id='status-<?=$dia?>' class="uk-float-right"></div>
    <?=CHtml::endForm();?>
  </div>
</div>
<br>