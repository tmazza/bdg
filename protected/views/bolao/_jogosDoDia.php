<?php
$fechamento = $bolao->getHoraFechamento($jogos);
?>
<div class="uk-panel uk-panel-box" >
  <h4>
    <?=date('d/m/Y',$dia);?>
    <small>
      <div data-uk-tooltip='' class="uk-float-right" title='Fechamento: <?=date('d/m/Y H:i:s',$fechamento-1)?>'>
        Fecha às <?=date('H:i:s',$fechamento-1)?>
      </div>
    </small>
  </h4>
  <div>
    <hr>
    <?=CHtml::beginForm('','POST',['id'=>'form-'.$dia]);?>
      <input type='hidden' name='dia' value='<?=$dia?>' />
      <input type='hidden' name='bolao' value='<?=$bolao->idBolao?>' />
      <?php $this->renderPartial('__formJogo',[
        'jogos'=>$jogos,
        'dia'=>$dia,
        'bolao'=>$bolao,
      ]);?>
      <?php
      echo CHtml::ajaxSubmitButton('Atualizar aposta',$this->createUrl('/bolao/salvaPalpite'),[
        'beforeSend'=>"js:function(){
          $('#dia-{$dia}').html('<i class=\'uk-icon uk-icon-spin uk-icon-spinner\'></i> Atualizando.');
        }",
        'success'=>"js:function(html){
            $('#dia-{$dia}').html(html);
            var icon = '<i class=\'uk-icon uk-icon-check\'></i>';
            $('#dia-{$dia}').append('<div class=\'uk-alert uk-alert-success\'>'+icon+' Atualizado.</div>');
        }",
      ],[
        'id'=>'btn-dia-'.$dia,
        'class'=>'uk-button uk-button-primary',
      ]);?>
    <?=CHtml::endForm();?>
  </div>
</div>
<br>
