<div class="uk-grid">

	<div class='uk-width-small-1-1 uk-visible-small'>
		<h4 class="uk-text-center"><?=$bolao->nome;?></h4>
		<ul class="uk-tab uk-tab-right uk-width-medium-1-2" >
		  <?php foreach ($this->menuLateral as $i) {
		    echo '<li ' . ($i[0]==$this->action->id?'class="uk-active"':'') . '>';
		    echo CHtml::link($i[1],$i[2],isset($i[3])?$i[3]:[]);
		    echo '</li>';
		  } ?>
		  <li class="uk-visible-small">
	  	  	<?php
		  	echo CHtml::ajaxLink("<i class='uk-icon uk-icon-gavel'></i>",$this->createUrl('/regulamento/bolao',[
				'id'=>$bolao->idBolao,
			]),HView::modalUpdate('main-modal-large'));
			?>
		  </li>
		</ul>
		<br>
	</div>

	<div class='uk-width-1-1 uk-hidden-small'>
		<?php if($bolao->isEncerrado): ?>
			<h3>
				<?=CHtml::link('Bolões', $this->createUrl('/site/index'));?>
				&raquo;
				<?=$bolao->nome;?>
				<small class="uk-badge">bolão encerrado</small>
			</h3>
		<?php else: ?> 
			<ul class="uk-tab">
				<?php $boloesInscritos = $this->getBoloesInscritos(); ?>
				<?php foreach ($boloesInscritos as $b): ?>
					<?php if(!$b->isEncerrado): ?> 
						<li <?=$b->idBolao == $bolao->idBolao ? 'class="uk-active"' : ''; ?>>
							<?php $img = CHtml::image($b->capa,'',['width'=>'50px',]); ?>
				    		<?=CHtml::link($img . ' ' . $b->nomeCurto,$this->createUrl('/bolao/index',[
				    			'id' => $b->idBolao,
				    		]));?>
				    	</li>
					<?php endif; ?> 
				<?php endforeach; ?>
			</ul>
		<?php endif; ?> 

	</div>
</div>

<?php
if($bolao->isUserPendente() && !$bolao->isEncerrado){
  echo '<br>';
  $this->renderPartial('/site/_inscricaoPendente',[
    'b'=>$bolao,
  ]);
}
?>
