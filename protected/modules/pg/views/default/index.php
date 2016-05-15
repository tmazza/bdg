<?php foreach ($boloes as $b) {
  echo CHtml::link($b->nome,$this->createUrl("/pg/comprar/bolao",[
    'id'=>$b->idBolao,
  ]),[
    'onclick' => '$(this).html("<i class=\"uk-icon uk-icon-spin uk-icon-spinner\"></i> Redirecionando para o PagSeguro. Aguarde...")',
  ]) . '&nbsp;&nbsp;&nbsp;&nbsp;R$ ' . number_format($b->valorInscricao,2,',','.') . '<br>';
}
