<?php $this->renderPartial('_headerBolao',['bolao'=>$bolao]); ?>
<div class="uk-grid">
  <div class='uk-width-medium-7-10 uk-width-small-1-1'>
	<?php
	$jogosPorDia = $bolao->getJogosFechados($listaCompleta ? false : 4);
	if(count($jogosPorDia) > 0) {
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
  } else {
    echo '<br><div class="uk-alert" style="margin: 0 auto;font-size: 18px;line-height: 26px;max-width: 320px;">';
    echo '<b>Nenhum jogo finalizado.</b><br>';
    echo '</div>';
  }
	?>
  </div>
  <div class='uk-width-medium-3-10 uk-hidden-small'>
    <?php $this->renderPartial('_menu',[
    	'bolao' => $bolao,
    ]); ?>
  </div>
</div>
