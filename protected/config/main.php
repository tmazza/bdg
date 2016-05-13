<?php

require(dirname(__FILE__) . '/__config.php');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => "BdG",
    'defaultController' => 'site',
     // preloading 'log' component
    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
        'application.extensions.*',
        'ext.ESES.*',
        'ext.lightopenid.*',
        'ext.eauth.*',
        'ext.eauth.services.*',
        'application.extensions.yii-ses.*',
        // 'application.extensions.yii-ses.vendor.phpmailer.phpmailer.*',
    ),
    'language' => 'pt_br',
    'modules' => array(
      'gii' => array(
          'class' => 'system.gii.GiiModule',
          'password' => 'bdg',
          'ipFilters' => array('*'),
      ),
      'editor',
      'pg',
    ),
    // application components
    'components' => array(
        'ses'=>array(
            'class' => 'SESComponent',
             /*
              * Use Amazon's "Access Credentials" here
              * Check out http://docs.aws.amazon.com/ses/latest/DeveloperGuide/smtp-credentials.html
              * if you get stuck with the credentials
              */
             'host' => $__awsSmtpHost, //Amazon Server
             'username' => $__awsUsername,    //Enter Username from Amazon
             'password' => $__awsPassword,    //Enter Pasword from Amazon
             'port' => 465,                        //Port number from Amazon
             'SMTPAuth' => true,
             'from' => "contato@bolaodogordo.com",    //From may be any email you want
             'fromName' => "Bolão do gordo",
             'charSet' => "UTF-8",
             'sender' => 'contato@bolaodogordo.com',  //Sender has to be verified email !!!
             'errorEmailAddresses' => array(),
        ),

        'loid' => array(
           'class' => 'ext.lightopenid.loid',
       ),
       'eauth' => array(
           'class' => 'ext.eauth.EAuth',
           'popup' => true, // Use the popup window instead of redirecting.
           'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache'.
           'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
           'services' => array( // You can change the providers and their classes.
               'facebook' => array(
                   // register your app here: https://developers.facebook.com/apps/
                   'class' => 'CustomFacebookService',
                   'client_id' => $__faceID,
                   'client_secret' => $__faceSecret,
               ),
              'google_oauth' => array(
                  // register your app here: https://code.google.com/apis/console/
                  'class' => 'GoogleOAuthService',
                  'client_id' => $__googleId,
                  'client_secret' => $__googleSecret,
              ),
           ),
       ),
       'curl' => array(
           'class' => 'ext.curl.Curl',
           'options' => array(),
       ),
       'user' => array(
            'allowAutoLogin' => true,
            'loginUrl' => '/site/login',
        ),
        'cache' => array(
            'class' => 'CFileCache',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager'  => require(dirname(__FILE__) . '/rotas.php'),
        'db'          => require(dirname(__FILE__) . '/database.php'),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            'itemTable' => 'seg_authitem',
            'itemChildTable' => 'seg_authitemchild',
            'assignmentTable' => 'seg_authassignment',
        ),

        'errorHandler' => array(
            'errorAction' => '/site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters'=>array('127.0.0.1'),
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error',
                    'logFile' => 'error',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'warning',
                    'logFile' => 'warning',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'trace',
                    'logFile' => 'trace',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'pg',
                    'logFile' => 'pg',
                ),
            ),
        ),
    ),
    'params' => array(
        'adminEmail' => $__emailDeNotificacao,
        'domain' => $__dominio,
        'bucketId' => $__s3BucketId,
        'bucketEndPoint' => $__s3BucketEndPoint,
    ),
);
