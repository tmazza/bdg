<div class="uk-alert uk-alert-danger">
  <a href="#!" class="uk-alert-close uk-close" onclick="$(this).parent().remove()"></a>
  <b>Sua inscrição nesse bolão está pendente.</b>
  Efeteu o pagamento para ativá-la. <br>
  <br>
      Valor da inscrição:
  <span class="uk-badge uk-badge-notification uk-badge-success">
    R$ <?=number_format($b->valorInscricao,2,',','.')?>
  </span>
  <br>
  <br>
  <?php
  echo CHtml::link('Realizar pagamento (através do PagSeguro)',$this->createUrl('/pg/comprar/bolao',[
    'id'=>$b->idBolao,
  ]),[
    'class'=>'uk-button uk-button-primary',
    'onClick'=>'$(this).html("<i class=\'uk-icon uk-icon-spin uk-icon-spinner\'></i> Redirecionando para o PagSeguro. Aguarde...")',
  ]);
  ?>
</div>
