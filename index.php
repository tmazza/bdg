<?php
date_default_timezone_set('America/Sao_Paulo');
$yii = dirname(__FILE__) . '/src/yii/framework/yiilite.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

$ambientesDeDesenvolvimento = ['localhost:8000','localhost:8080'];
defined('YII_DEBUG') or define('YII_DEBUG', in_array($_SERVER['HTTP_HOST'], $ambientesDeDesenvolvimento));
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

if(YII_DEBUG){
  error_reporting(E_ALL);
  ini_set('display_errors', 'On');
}

require_once("protected/extensions/yii-ses/vendor/autoload.php");
require_once("protected/modules/pg/vendor/sdk-pg/source/PagSeguroLibrary/PagSeguroLibrary.php");
require_once($yii);
Yii::createWebApplication($config)->run();
