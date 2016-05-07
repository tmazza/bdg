<?php

/**
 * Extension of the PHPMailer class. Wraps that functionality to make easy email calls.
 *
 * @author kirk.hansen
 */
class Mailer extends \PHPMailer {

    var $Host = ""; //Amazon Server
    var $Username = "";    //Enter Username from Amazon
    var $Password = "";  //Enter Pasword from Amazon
    var $Port = 465;                        //Port number from Amazon
    var $SMTPAuth = true;
    var $From = "";    //From may be any email you want
    var $FromName = "";
    var $CharSet = "";
    var $Sender = '';  //Sender has to be verified email !!!
		var $SMTPDebug  = false;             // set true if you want to debug

	 /**
    * Prevents the SMTP connection from being closed after each mail
    * sending. If this is set to true then to close the connection
    * requires an explicit call to SmtpClose().
    * @var bool
    */
    var $SMTPKeepAlive = true;



    function Mailer($host,$username,$password,
				$port,$SMTPAuth,$from,$fromName,$charSet,
				$sender)
	{
        parent::__construct(true); //enables exceptions
        $this->IsSMTP();
		$this->Host = $host;
		$this->Username = $username;
		$this->Password = $password;
		$this->Port = $port;
		$this->SMTPAuth = $SMTPAuth;
		$this->From = $from;
		$this->FromName = $fromName;
		$this->CharSet = $charSet;
		$this->Sender = $sender;
    }

    function sendEmail($email,$subject,$body){
        try
        {


             $this->ClearAddresses();
             $this->SingleTo = true;
             mb_internal_encoding("UTF-8");  //If you send in UTF-8 Encoding
             $this->AddAddress($email,'asd');
             $this->addComponents($subject, $body);
						   $this->isHTML(true);
			      $this->Send();
        } catch (phpmailerException $e) {
	        Yii::log($e->errorMessage(), \CLogger::LEVEL_ERROR, 'application.extensions.ses');
            return false;
        } catch (Exception $e) {
	        Yii::log($e->getMessage(), \CLogger::LEVEL_ERROR, 'application.extensions.ses');
            return false;
        }
    }

	/**
	 * I was told CC was not proper. So this sends them all as the "To:" field.
	 * @param array $emails
	 * @param type $subject
	 * @param type $body
	 */
	function sendEmails(array $recipients, $subject,$body)
    {
        try
        {
            $this->clearAddresses();
            foreach($recipients as $email => $name)
            {
                $this->addAddress($email,$name);
            }

            $this->addComponents($subject, $body);
            $this->isHTML(true);
            $this->Send();
        } catch (phpmailerException $e) {
	        Yii::log($e->errorMessage(), \CLogger::LEVEL_ERROR, 'application.extensions.ses');
            return false;
        } catch (Exception $e) {
	        Yii::log($e->getMessage(), \CLogger::LEVEL_ERROR, 'application.extensions.ses');
            return false;
        }
        return true;

	}

	private function addComponents($subject,$body)
	{
		$this->Subject = $subject;
		$this->Body = $body;
	}

}

?>
