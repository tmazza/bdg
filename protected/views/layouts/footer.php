<br>
<hr>
<br>
<footer>
  <div class="uk-container uk-container-center">
    <ul class="uk-list">
      <li><?=CHtml::link("<i class='uk-icon uk-icon-soccer-ball-o'></i> Regulamento",$this->createUrl('/regulamento/geral'),['class'=>'uk-button uk-button-link'])?></li>
      <li><?=CHtml::link("Sobre o PagSeguro",'https://pagseguro.uol.com.br/para_voce/como_funciona.jhtml',['class'=>'uk-button uk-button-link'])?></li>
      <li><?=CHtml::link("<i class='uk-icon uk-icon-github'></i> Repositório",'https://github.com/tmazza/bdg',['class'=>'uk-button uk-button-link'])?></li>
    </ul>
  </div>
  <br><br><br>
</footer>
<?php $this->renderPartial('//layouts/_addsFooter');?>
