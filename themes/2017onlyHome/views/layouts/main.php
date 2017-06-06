<!DOCTYPE html>
<!--
  Transit by TEMPLATED
  templated.co @templatedco
  Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <title>Bolão do Gordo</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!--[if lte IE 8]><script src="<?=$this->assetsDir;?>/2017onlyHome/js/html5shiv.js"></script><![endif]-->
    <script src="<?=$this->assetsDir;?>/2017onlyHome/js/jquery.min.js"></script>
    <script src="<?=$this->assetsDir;?>/2017onlyHome/js/skel.min.js"></script>
    <script src="<?=$this->assetsDir;?>/2017onlyHome/js/skel-layers.min.js"></script>
    <script src="<?=$this->assetsDir;?>/2017onlyHome/js/init.js"></script>
    <link rel="stylesheet" href="<?=$this->assetsDir;?>/2017onlyHome/css/skel.css" />
    <link rel="stylesheet" href="<?=$this->assetsDir;?>/2017onlyHome/css/style.css" />
    <link rel="stylesheet" href="<?=$this->assetsDir;?>/2017onlyHome/css/style-xlarge.css" />
  </head>
  <body class="landing">

    <!-- Header -->
      <header id="header">
        <a href="<?=$this->createUrl('/site/index');?>">
          <img style='float:left;' src="<?=$this->assetsDir;?>/images/logo-single.png" width=60px; />          
          <div style="float:left;margin-top:-15px;font-weight:bold;font-size:20px;color: white;">Bolão do gordo</div>
        </a>
        <nav id="nav">
          <ul>
            <li><a href="<?=$this->createUrl('/site/login');?>">Entrar</a></li>
            <li><a href="<?=$this->createUrl('/cadastro/index');?>" class="button special">Cadatre-se</a></li>
          </ul>
        </nav>
      </header>

    <!-- Banner -->
      <section id="banner">
        <h2 style="font-size: 30px;">Reunindo fãs do futebol desde 2007</h2>
        <p>Ganhe prêmios e divirta-se junto com amigos e familiares</p>
        <ul class="actions">
          <li>
            <a href="<?=$this->createUrl('/site/login');?>" class="button big" style='background: transparent;'>
              Entrar
            </a>
            <a href="<?=$this->createUrl('/cadastro/index');?>" class="button big">
              Cadastre-se
            </a>
          </li>
        </ul>
      </section>

    <section id="conheca" class="wrapper style1 special">
      <div class="container">
        <header class="major">
          <h2>Todo dia tem jogo !!</h2>
          <p>Em 2017 o bolão terá jogos das séries A e B do Brasileirão! Isso significa que tem jogo todos os dias da semana. Nesse ano, teremos apenas o bolão pago.</p>
        </header>
      </div>
      <div class="container">
        <header class="major">
          <h2>Como funciona?</h2>
          <p>
            Você cadastra seus palpites até meia hora antes do primeiro jogo do dia, e vai acumulando pontos em cada jogo.
            <br>
            Os primeiros colocados no final do campeonatos ganham prêmios em dinheiro.
            <?=CHtml::link("Clique aqui",$this->createUrl('/regulamento/geral'))?> e veja como funciona o sistema de pontuação.

            <br><br>
            Faça sua inscrição, o Bolão do Gordo 2017 inicia no dia 10/06.
            <br>
            <a href="<?=$this->createUrl('/site/login');?>">Conhecer</a>
          </p>
        </header>
      </div>
    </section>

    <!-- Footer -->
      <footer id="footer">
        <div class="container">
          <section class="links" style="padding-bottom: 0px;">
                <ul class="">
                  <li><?=CHtml::link("<i class='uk-icon uk-icon-soccer-ball-o'></i> Regulamento geral",$this->createUrl('/regulamento/geral'),['class'=>'uk-button uk-button-link'])?></li>
                  <li><?=CHtml::link("Sobre o PagSeguro",'https://pagseguro.uol.com.br/para_voce/como_funciona.jhtml',['class'=>'uk-button uk-button-link'])?></li>
                  <li><?=CHtml::link("<i class='uk-icon uk-icon-bug'></i> Reportar um erro",'https://github.com/tmazza/BdG/issues/new',['class'=>'uk-button uk-button-link'])?></li>
                </ul>
          </section>
          <div >
            Design by <a href="http://templated.co">templated</a> | Code at
            <a href="https://github.com/tmazza/bdg" target="_blank" title="GitHub">Github</a>

            <ul style="float: right;" class="icons">
              <li>
                  <a href="https://www.facebook.com/bolaodogordo" target="_blank" class="icon rounded fa-facebook" data-uk-tooltip title="Facebook"><span class="label">Facebook</span></a>
              </li>
              <li>
                  <a href="https://twitter.com/bolaodogordo" target="_blank" class="icon rounded fa-twitter" data-uk-tooltip title="Twitter"><span class="label">Twitter</span></a>
              </li>
              <li>
              </li>
            </ul>
          </div>
        </div>
      </footer>



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