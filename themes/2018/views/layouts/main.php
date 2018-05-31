<!DOCTYPE HTML>
<html lang="pt-br">
  <head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bolão do Gordo</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--
    Oxygen by gettemplates.co
    Twitter: http://twitter.com/gettemplateco
    URL: http://gettemplates.co
  -->
  <link rel="stylesheet" href="<?=$this->assetsDir;?>/2018/css/animate.css">
  <link rel="stylesheet" href="<?=$this->assetsDir;?>/2018/css/bootstrap.css">
  <link rel="stylesheet" href="<?=$this->assetsDir;?>/2018/css/style.css">
  <!-- Modernizr JS -->
  <script src="<?=$this->assetsDir;?>/2018/js/modernizr-2.6.2.min.js"></script>
  <!-- FOR IE9 below -->
  <!--[if lt IE 9]>
  <script src="<?=$this->assetsDir;?>/2018/js/respond.min.js"></script>
  <![endif]-->

  </head>
  <body>
    
  <div class="gtco-loader"></div>
  
  <div id="page">
  <nav class="gtco-nav" role="navigation">
    <div class="gtco-container">
      <div class="row">
        <div class="col-xs-8">
          <div id="gtco-logo">
            <?php
            echo CHtml::link('Bolão do Gordo', $this->createUrl('/'));
            ?>
          </div>
        </div>
        <div class="col-xs-2 text-center menu-1"></div>
        <div class="col-xs-2 text-right hidden-xs menu-2">
          <ul>
            <li class="btn-cta">
              <a href="<?=$this->createUrl('/site/login');?>"><span>Entrar</span></a>
            </li>
          </ul>
        </div>
      </div>
      
    </div>
  </nav>

  <header id="gtco-header" class="gtco-cover" role="banner" style="background-image:url(<?=$this->assetsDir;?>/2018/images/img_bg_1.jpg);">
    <div class="gtco-container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center">
          <div class="display-t">
            <div class="display-tc animate-box" data-animate-effect="fadeIn">
              <?php
              echo CHtml::image($this->assetsDir . '/images/logo-single.png', '', [
                'width' => '100px',
              ]);
              ?>
              <br>
              <h1 style="font-size: 2.0em">Reunindo fãs do futebol desde 2007</h1>
              <h2>Ganhe prêmios e divirta-se junto com amigos e familiares</h2>
              <p>
                <a href="<?=$this->createUrl('/cadastro/index');?>" class="btn btn-default">Conheça</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  
  <footer id="gtco-footer" role="contentinfo">
    <div class="gtco-container">
      <div class="row row-pb-md">
        <div class="col-md-4 gtco-widget">
          <h3>Como funciona?</h3>
          <p style="text-align:justify;">Você cadastra seus palpites até meia hora antes do primeiro jogo do dia, e vai acumulando pontos em cada jogo. Os primeiros colocados no final do campeonatos ganham prêmios em dinheiro. </p>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1">
          <ul class="gtco-footer-links">
            <li>
              <?=CHtml::link("Regulamento geral", $this->createUrl('/regulamento/geral'));?>
            </li>
            <li>
              <?php
              $url = 'https://pagseguro.uol.com.br/para_voce/como_funciona.jhtml';
              echo CHtml::link("Sobre o PagSeguro &#8599;", $url, [
                'target' => '_blank',
              ]);
              ?>
            </li>
            <li>
              <?php
              $url = 'https://github.com/tmazza/BdG/issues/new';
              echo CHtml::link("Reportar um erro &#8599;", $url, [
                'target' => '_blank',
              ]);
              ?>
            </li>

          </ul>
        </div>
      </div>

      <div class="row copyright">
        <div class="col-md-12">
          <p class="pull-left">
            <small class="block">&copy; <?=date('Y')?>. All Rights Reserved.</small> 
          </p>
          <p class="pull-right">
            <ul class="gtco-social-icons pull-right">
              <li>
                <a href="https://www.facebook.com/bolaodogordo">
                  <i class="icon-twitter"></i>
                </a>
              </li>
              <li>
                <a href="https://twitter.com/bolaodogordo">
                  <i class="icon-facebook"></i>
                </a>
              </li>
            </ul>
          </p>
        </div>
      </div>

    </div>
  </footer>
  </div>

  <script src="<?=$this->assetsDir;?>/2018/js/jquery.min.js"></script>
  <script src="<?=$this->assetsDir;?>/2018/js/jquery.waypoints.min.js"></script>
  <script src="<?=$this->assetsDir;?>/2018/js/owl.carousel.min.js"></script>
  <script src="<?=$this->assetsDir;?>/2018/js/main.js"></script>

  <?php if(!YII_DEBUG): ?>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-31889911-1', 'auto');
  ga('send', 'pageview');
  </script>
  <?php endif; ?>
  </body>
</html>

