<?php

class HEmail {

  /**
   *
   */
  public static function templateSimples($email,$assunto,$msg){
    $content = 'TODO';
    // $content = Yii::app()->controller->renderPartial('application.views.main.templateEmail1',array('msg'=>$msg),true);
    // Yii::app()->ses->mailer->AddEmbeddedImage(Yii::getPathOfAlias('application').'/webroot/images/logo.png', 'logo');
    Yii::app()->ses->sendEmail($email,$assunto,$content);
  }

}
