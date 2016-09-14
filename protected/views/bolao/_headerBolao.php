<div class="uk-grid">
	<div class='uk-width-small-1-1 uk-visible-small'>
		<h4 class="uk-text-center"><?=$bolao->nome;?></h4>
		<ul class="uk-tab uk-tab-right uk-width-medium-1-2" >
		  <?php foreach ($this->menuLateral as $i) {
		    echo '<li ' . ($i[0]==$this->action->id?'class="uk-active"':'') . '>';
		    echo CHtml::link($i[1],$i[2],isset($i[3])?$i[3]:[]);
		    echo '</li>';
		  } ?>
		</ul>
		<br>
	</div>

	<div class='uk-width-1-1 uk-hidden-small'>
		<h3>
		  <?=CHtml::link('Bolões',$this->createUrl('/site/index'))?> &raquo;
		  <?=$bolao->nome;?>
		</h3>
		<?php
		if($bolao->isUserPendente()){
		  $this->renderPartial('/site/_inscricaoPendente',[
		    'b'=>$bolao,
		  ]);
		}
		?>
	</div>
</div>
