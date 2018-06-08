<?php $this->renderPartial('_headerBolao',['bolao'=>$bolao]); ?>
<div class="uk-grid">
  <div class='uk-width-medium-7-10 uk-width-small-1-1'>
      <?php
		$jogosPorDia = $bolao->getJogosEmAberto();
		foreach ($jogosPorDia as $dia => $jogos) {
		  $this->renderPartial('_jogosDoDia',[
		    'bolao'=>$bolao,
		    'dia'=>$dia,
		    'jogos'=>$jogos,
		  ]);
		}
		?>
  </div>
  <div class='uk-width-medium-3-10 uk-hidden-small'>
    <?php $this->renderPartial('_menu',[
    	'bolao' => $bolao,
    ]); ?>
  </div>
</div>

  <?php
    echo CHtml::ajaxLink("Regulamento desse bolão",$this->createUrl('/regulamento/bolao',[
    'id'=>$bolao->idBolao,
  ]), HView::modalUpdate('main-modal-large'),[
    'class'=>'uk-button',
  ]);
  ?>
