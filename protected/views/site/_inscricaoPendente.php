<?php
$inscricao = $b->getInscricao(Yii::app()->user->id);
?>
<?php if(!is_null($inscricao)): ?>
  <div class="uk-alert uk-alert-danger" style="max-width: 600px;margin: 0 auto;margin-bottom:12px;">
    <a href="#!" class="uk-alert-close uk-close" onclick="$(this).parent().remove()"></a>
    <b>Sua inscrição nesse bolão está pendente.</b>
    Efetue o pagamento até
    <?php
    $data = $inscricao->dataInscricao;
    if($b->codCampeonato == 'COP18'){
      echo HView::tradDia(date('l, d/m',Bolao::dataCarencia()));
    } else {
      echo HView::tradDia(date('l, d/m',$data+14*24*60*60));
    }
    ?>.
    <br>
    Após esta data suas apostas não serão consideradas enquanto a inscrição não for ativada.
    <br><br>
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
<?php endif; ?>