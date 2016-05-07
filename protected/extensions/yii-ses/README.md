Setup 
======
Please note that SES by amazon must be setup on the server. 
Please see their setup instructions on how to do so.

1. Put the SES directory in the extensions.
2. Install phpmailer 5.2.7 (I'd recommend composer)
3. Go to the main.php (or wherever you want this component to be) and add the configuration:


			imports(array(
			'application.extensions.SES.*, (or whatever... just autoload the classes somehow)
			))

			components(
			array(
				'ses'=>array(
						'class' => 'SESComponent',
						 'host' => "tls://email-smtp.us-east-1.amazonaws.com", //Amazon Server
						 /*
						  * Use Amazon's "Access Credentials" here
						  * Check out http://docs.aws.amazon.com/ses/latest/DeveloperGuide/smtp-credentials.html
						  * if you get stuck with the credentials
						  */
						 'username' => "xxxxxxxxxxxxxxxxxx",    //Enter Username from Amazon 
						 'password' => "xxxxxxxxxxxxxxxxxxxx",  //Enter Pasword from Amazon 
						 'port' => 465,                        //Port number from Amazon 
						 'SMTPAuth' => true, 
						 'from' => "xxx@xxxxxx.xxx",    //From may be any email you want 
						 'fromName' => "xxxxxxxxxxxx", 
						 'charSet' => "UTF-8", 
						 'sender' => 'xxxxxx@xxxxxxx.xxx',  //Sender has to be verified email !!! 
						 'errorEmailAddresses' => array(
								'xxx@xxxxx.comxx'=> "name1",
								'2@xxxx.com' => 'name2',
							),
					),
			)


Usage
======

	Yii::app()->ses->sendEmail("test@whatever.com","My first email","Hello World!");
	Yii::app()->ses->sendEmails(array("test@coolman.com"=>"Test User Name"), "My first email!", "Hello World!");

Configuration Suggestions
======
I just include the composer autoload file located in ```/root/wherever/you/ran/composer install/vendor/autoload.php``` right BEFORE you require Yii. 
Yii's autoloader is pissy and likes to be last.

Example index.php file:


        <?php
        ini_set('display_errors', true);
        // change the following paths if necessary
        $yii= dirname(__FILE__).'/yii/framework/yii.php';
        $config=dirname(__FILE__).'/protected/config/main.php';
        
        
        // remove the following lines when in production mode
        //defined('YII_DEBUG') or define('YII_DEBUG',true);
        // specify how many levels of call stack should be shown in each log message
        defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
        
		require_once("/path/to/composer/autoload.php");
        require_once($yii);
        Yii::createWebApplication($config)->run();

That way, everything you install with composer will be autoloaded :)
