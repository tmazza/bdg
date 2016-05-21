<br>
<hr>
<br>
<footer>
  <div class="uk-container uk-container-center">
    <div class="uk-float-right">
      <a href="https://www.facebook.com/bolaodogordo" class="uk-icon-hover uk-icon-large uk-icon-facebook-official" data-uk-tooltip title="Facebook"></a>&nbsp;&nbsp;
      <a href="https://twitter.com/bolaodogordo" class="uk-icon-hover uk-icon-large uk-icon-twitter" data-uk-tooltip title="Twitter"></a>&nbsp;&nbsp;
      <a href="https://github.com/tmazza/bdg" class="uk-icon-hover uk-icon-large uk-icon-github" data-uk-tooltip title="GitHub"></a>
    </div>
    <ul class="uk-list">
      <li><?=CHtml::link("<i class='uk-icon uk-icon-soccer-ball-o'></i> Regulamento geral",$this->createUrl('/regulamento/geral'),['class'=>'uk-button uk-button-link'])?></li>
      <li><?=CHtml::link("Sobre o PagSeguro",'https://pagseguro.uol.com.br/para_voce/como_funciona.jhtml',['class'=>'uk-button uk-button-link'])?></li>
      <li><?=CHtml::link("<i class='uk-icon uk-icon-bug'></i> Reportar um erro",'https://github.com/tmazza/BdG/issues/new',['class'=>'uk-button uk-button-link'])?></li>
    </ul>
  </div>
  <br><br><br>
</footer>
<?php $this->renderPartial('//layouts/_addsFooter');?>
