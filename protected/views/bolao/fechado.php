<?php
$this->renderPartial('_headerBolao',['bolao'=>$bolao]);
$jogosPorDia = $bolao->getJogosFechados($listaCompleta ? false : 4);
foreach ($jogosPorDia as $dia => $jogos) {
  $this->renderPartial('_jogosFechados',[
    'dia'=>$dia,
    'jogos'=>$jogos,
    'bolao'=>$bolao,
  ]);
}
if(!$listaCompleta){
	echo CHtml::link('Ver lista completa dos jogos fechados',$this->createUrl('/bolao/fechado',[
		'id'=>$bolao->idBolao,
		'listaCompleta'=>true,
	]),[
		'class'=>'uk-button uk-button-primary',
	]);
}
?>
