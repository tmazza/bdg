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
