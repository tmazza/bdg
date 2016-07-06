<br>
<hr>
<footer>
<div class="uk-container uk-container-center uk-text-center">
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- rodape -->
  <ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-3847082477827226"
     data-ad-slot="1958616887"></ins>
  <script>
  (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
</div>   
<br><br> 
  <div class="uk-grid">
    <div class="uk-width-medium-1-2 uk-width-small-1-1">

</div>
    <div class="uk-width-medium-1-2 uk-width-small-1-1">

    </div>
  </div>
  <div class="uk-container uk-container-center">
    <div class="uk-grid">
      <div class="uk-width-medium-1-2">
        <ul class="uk-list">
          <li><?=CHtml::link("<i class='uk-icon uk-icon-soccer-ball-o'></i> Regulamento geral",$this->createUrl('/regulamento/geral'),['class'=>'uk-button uk-button-link'])?></li>
          <li><?=CHtml::link("Sobre o PagSeguro",'https://pagseguro.uol.com.br/para_voce/como_funciona.jhtml',['class'=>'uk-button uk-button-link'])?></li>
          <li><?=CHtml::link("<i class='uk-icon uk-icon-bug'></i> Reportar um erro",'https://github.com/tmazza/BdG/issues/new',['class'=>'uk-button uk-button-link'])?></li>
        </ul>
      </div>
      <div class="uk-width-medium-1-2 uk-text-right uk-text-center-small uk-width-small-1-1">
        <div class='uk-visible-small'><br></div>
        <a href="https://www.facebook.com/bolaodogordo" class="uk-icon-hover uk-icon-large uk-icon-facebook-official" data-uk-tooltip title="Facebook"></a>&nbsp;&nbsp;
        <a href="https://twitter.com/bolaodogordo" class="uk-icon-hover uk-icon-large uk-icon-twitter" data-uk-tooltip title="Twitter"></a>&nbsp;&nbsp;
        <a href="https://github.com/tmazza/bdg" class="uk-icon-hover uk-icon-large uk-icon-github" data-uk-tooltip title="GitHub"></a>
        <br>
        <div class="uk-hidden-small">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.6&appId=622815311209366";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-like" data-href="https://www.facebook.com/bolaodogordo" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
        </div>
      </div>
    </div>
  </div><br>
</footer>
<?php $this->renderPartial('//layouts/_addsFooter');?>
