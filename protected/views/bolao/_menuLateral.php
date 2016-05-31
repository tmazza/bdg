<br><hr>
<ul class="uk-list">
  <li><?=CHtml::ajaxLink("Regulamento do bolão",$this->createUrl('/regulamento/bolao',[
    'id'=>$bolao->idBolao,
  ]),HView::modalUpdate('main-modal-large'))?></li>
</ul>
<br>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Lateral -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:600px"
     data-ad-client="ca-pub-3847082477827226"
     data-ad-slot="7794195282"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?php
// echo CHtml::ajaxLink('Ver tabela do Brasileirão',$this->createUrl('/bolao/loadTabBra'),[
//   'success'=>'js:function(html){ $("#ver-tabela").html(html); }',
// ],[
//   'onclick'=>'$(this).slideUp();',
//   'class'=>'uk-hidden-small uk-button',
// ]);
?>
<!-- <div id='ver-tabela' data-uk-sticky="{top:5,boundary: true}"></div> -->
