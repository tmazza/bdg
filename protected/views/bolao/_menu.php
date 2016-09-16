<ul class="uk-tab uk-tab-right" >
  <?php foreach ($this->menuLateral as $i) {
    echo '<li ' . ($i[0]==$this->action->id?'class="uk-active"':'') . '>';
    echo CHtml::link($i[1],$i[2],isset($i[3])?$i[3]:[]);
    echo '</li>';
  } ?>
</ul>

<br><hr>

<ul class="uk-nav">
	<!-- Regulamento -->
  	<li>
  	<?php
  	echo CHtml::ajaxLink("&nbsp;&nbsp;&nbsp;&nbsp;Regulamento desse bolão",$this->createUrl('/regulamento/bolao',[
		'id'=>$bolao->idBolao,
	]),HView::modalUpdate('main-modal-large'),[
	  'class'=>'uk-button',
	]);
	?>
	</li>
	<!-- Tabela do brasilerio -->
	<?php if(substr($bolao->codCampeonato, 0,3) == 'BRA'): ?>
	<li class="uk-hidden-small">
		<!-- <div class="uk-badge uk-badge-danger uk-float-left">Novo</div> -->
		<?php
		echo CHtml::ajaxLink('Tabela do Brasileirão',$this->createUrl('/bolao/TabelaBrasileirao'),[
		  'success'=>'js:function(html){ $("#ver-tabela").html(html); }',
		],[
		  'onclick'=>'$(this).parent().remove();',
		  'class'=>'uk-button',
		]);
		?>
	</li>
	<?php endif; ?>
</ul>
<div id='ver-tabela'></div>
<!-- Ads -->
<br>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Lateral -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:600px;background:transparent!important"
     data-ad-client="ca-pub-3847082477827226"
     data-ad-slot="7794195282"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
