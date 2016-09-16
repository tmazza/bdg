<?php if(!is_null($bolao->userVencedor)): ?>
	<br><br>
	<div class="uk-text-center">
		<?php
		if(!is_null($bolao->badgeCampeao)){
			echo CHtml::image($bolao->badgeCampeao,'Winner bolão');
		}
		?>
		<h3>
		<b style="font-size: 24px;">
			<?=$bolao->userVencedor->nome?>		
		</b> <br>
		<?=$bolao->getTextoVitoria();?></h3>
	</div>
	<br><br>
<?php endif; ?>