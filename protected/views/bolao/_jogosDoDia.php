<?php
$fechamento = $bolao->getHoraFechamento($jogos);
?>
<div class="uk-panel uk-panel-box" >
  <h4>
    <?=date('d/m/Y',$dia);?>
    <small>
      <div data-uk-tooltip='' class="uk-float-right" title='Após este horário você não poderá salvar os palpites do dia.'>
        <div class="uk-hidden-small">
          Fecha às <?=date('H:i:s \d\e d/m/Y',$fechamento-1)?>
        </div>
        <div class="uk-visible-small">
          Fecha às <?=date('H:i:s',$fechamento-1)?>
        </div>
      </div>
    </small>
  </h4>
  <div>
    <hr>
    <?=CHtml::beginForm('','POST',['id'=>'form-'.$dia,'class'=>'uk-form']);?>
      <input type='hidden' name='dia' value='<?=$dia?>' />
      <input type='hidden' name='bolao' value='<?=$bolao->idBolao?>' />
      <?php $this->renderPartial('__formJogo',[
        'jogos'=>$jogos,
        'dia'=>$dia,
        'bolao'=>$bolao,
      ]);?>
      <br>
      <?php
      echo CHtml::ajaxSubmitButton('Atualizar palpite',$this->createUrl('/bolao/salvaPalpite'),[
        'beforeSend'=>"js:function(){
          $('#dia-{$dia}').find('input').prop('disabled','1');
          var icon = '<i class=\'uk-icon uk-icon-spin uk-icon-spinner\'></i>';
          $('#status-{$dia}').html('<div class=\'uk-alert\'>'+icon+' Atualizando aguarde...</div>');
        }",
        'success'=>"js:function(html){
            $('#dia-{$dia}').html(html);
            var icon = '<i class=\'uk-icon uk-icon-check\'></i>';
            $('#status-{$dia}').html('<div class=\'uk-alert uk-alert-success\'>'+icon+' Palpite atualizado.</div>');
        }",
        'error'=>"js:function(){
            var icon = '<i class=\'uk-icon uk-icon-times\'></i>';
            $('#status-{$dia}').html('<div class=\'uk-alert uk-alert-danger\'>'+icon+' Erro ao salvar palpite. Atualize a página e tente novamente.</div>');
        }",
      ],[
        'id'=>'btn-dia-'.$dia,
        'class'=>'uk-button uk-button-primary',
        'style'=>'color:white',
      ]);?>
      <div id='status-<?=$dia?>' class="uk-float-right"></div>
    <?=CHtml::endForm();?>
  </div>
</div>
<br>
