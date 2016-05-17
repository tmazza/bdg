<?php
require(dirname(__FILE__) . '/__config.php');

return [
  'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'import' => [
      'application.models.*',
      'application.helpers.*',
      'application.vendor.SimpleHTMLDOM.*',
      'application.extensions.yii-ses.*',
	],
	'components' => [
		'db' => require(dirname(__FILE__) . '/database.php'),
    'ses'=>array(
        'class' => 'SESComponent',
         'host' => $__awsSmtpHost, //Amazon Server
         'username' => $__awsUsername,    //Enter Username from Amazon
         'password' => $__awsPassword,    //Enter Pasword from Amazon
         'port' => 465,                        //Port number from Amazon
         'SMTPAuth' => true,
         'from' => $__awsEmail,    //From may be any email you want
         'fromName' => "Bolão do gordo",
         'charSet' => "UTF-8",
         'sender' => $__awsEmail,  //Sender has to be verified email !!!
         'errorEmailAddresses' => array(),
    ),
	],
  'params' => array(
      'adminEmail' => $__emailDeNotificacao,
      'domain' => $__dominio,
  ),
];
