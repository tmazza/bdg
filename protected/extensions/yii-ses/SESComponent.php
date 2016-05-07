<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SESComponent
 * Dependent upon PHPMailer class. I extend PHPMailer and that's what I'm creating
 * in the init.
 * @author kirk.hansen
 */
class SESComponent extends CApplicationComponent{

	public $host; //Amazon Server
    public $username;    //Enter Username from Amazon
    public $password;  //Enter Pasword from Amazon
    public $port;                        //Port number from Amazon
    public $SMTPAuth;
    public $from;    //From may be any email you want
    public $fromName;
    public $charSet;
    public $sender;  //Sender has to be verified email !!!
	public $errorEmailAddresses;

	public $mailer; //will be a mailer object that extends PHPMailer

	/**
	 * Initializes the component.
	 * Wish we had multiple inheritance. I can't get around the idea of not
	 * having it, so this is my solution. Using a DIC may be a better approach,however.
	 */


	public function init()
	{
		parent::init();
		//HATE THIS. Is there a way around it?
		$this->mailer = new Mailer($this->host,$this->username,$this->password,
				$this->port,$this->SMTPAuth,$this->from,$this->fromName,$this->charSet,
				$this->sender);
	}

	/**
	 *
	 * @param string $emails
	 * @param type $subject
	 * @param mixed $body Should be a string or an associative array where the keys match your template variables.
	 */
	public function sendEmail($email,$subject,$body,$template="default")
	{
		//if you send an array of variables, you MUST provide a new template.
		// if (gettype($body) === "array") {
		// 	if ($template === "default") {
		// 		return false;
		// 	}
		// 	$getVariables = $this->createGetRequestString($body);
		// 	$body = file_get_contents(
		// 		Yii::app()->getBaseUrl(true) .
		// 		"/protected/extensions/SES/templates/{$template}.php?" .
		// 		$getVariables
		// 	);
		// }
		$this->mailer->sendEmail($email, $subject, $body);
	}

	/**
	 *
	 * @param type $recipients
	 * @param type $subject
	 * @param mixed $body Should be a string or an associative array where the keys match your template variables.
	 */
	public function sendEmails($recipients,$subject,$body,$template="default")
	{
		//if you send an array of variables, you MUST provide a new template.
		if (gettype($body) === "array") {
			if ($template === "default") {
				return false;
			}
			$getVariables = $this->createGetRequestString($body);
			$body = file_get_contents(
				Yii::app()->getBaseUrl(true) .
				"/protected/extensions/SES/templates/{$template}.php?" .
				$getVariables
			);
		}
		$this->mailer->sendEmails($recipients, $subject, $body);
	}

	/**
	 *
	 * @param type $recipients
	 * @param type $subject
	 * @param type $body
	 */
	public function sendErrorEmails($subject,$body)
	{
		$this->mailer->sendEmails($this->errorEmailAddresses,$subject,$body);
	}

	private function createGetRequestString(array $body)
	{
		return http_build_query($body);
	}

}

?>
