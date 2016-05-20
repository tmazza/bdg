<br><hr>
<ul class="uk-list">
  <li><?=CHtml::ajaxLink("Regulamento do bolão",$this->createUrl('/regulamento/bolao',[
    'id'=>$bolao->idBolao,
  ]),HView::modalUpdate('main-modal-large'))?></li>
</ul>

<?php
// echo CHtml::ajaxLink('Ver tabela do Brasileirão',$this->createUrl('/bolao/loadTabBra'),[
//   'success'=>'js:function(html){ $("#ver-tabela").html(html); }',
// ],[
//   'onclick'=>'$(this).slideUp();',
//   'class'=>'uk-hidden-small uk-button',
// ]);
?>
<!-- <div id='ver-tabela' data-uk-sticky="{top:5,boundary: true}"></div> -->
