<head>
    <title><?=$this->pagTitulo;?></title>

    <meta charset="utf-8" />
    <link rel="manifest" href="laucher/manifest.json">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?=$this->pagDescricao?>">
    <meta name="keywords" content="<?=$this->pagPalavras?>">

    <!-- favicon -->
    <link rel="shortcut icon" href="<?=Yii::app()->baseUrl;?>/favicon.ico?v3"/>

    <!-- estilos -->
    <link rel="stylesheet" href="<?=$this->assetsDir;?>/uikit/css/uikit.almost-flat.min.css" />
    <link rel="stylesheet" href="<?=$this->assetsDir;?>/css/main.css" />
    <link rel="stylesheet" href="<?=$this->assetsDir;?>/uikit/css/components/tooltip.min.css" />

    <?php if(!YII_DEBUG): ?>
      <!-- Analytics -->
      <!-- <script></script> -->
    <?php endif; ?>

</head>