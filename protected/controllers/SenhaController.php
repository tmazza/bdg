<?php

class SenhaController extends MainController {

  public function actionRecuperar(){
    if(isset($_POST['email'])){
      $email = addslashes($_POST['email']);
      $user = User::model()->findByAttributes(array(
        'email' => $_POST['email'],
      ));
      if(is_null($user)){
       HView::ferr('Nenhum usuário encontardo com o email "'.$_POST['email'].'".');
     } else {
        $requisicaoAtiva = UserSenha::model()->find(array(
          'condition' => "user_id = {$user->id} AND estado = " .  UserSenha::Ativa . " AND data > " . (time()-(60*60*3)),
        ));

        if(is_null($requisicaoAtiva)){
          $requisicao = new UserSenha();
          $requisicao->user_id = $user->id;
          $requisicao->hash = $this->getHash($user);
          $requisicao->estado = 1; // Em aberto
          $requisicao->data = time();
          try {
            $requisicao->save();
          } catch (Exception $e){
            HView::ferr('Sua solicitação não pode ser processada, tente novamente.');
            $this->redirect($this->createUrl('/site/login'));
          }
        } else {
          $requisicao = $requisicaoAtiva;
        }
        $this->sendEmail($requisicao);
      }
      $this->redirect($this->createUrl('/site/login'));
    }
  }

  public function actionAlterar($h){
    if(strlen($h) < 300){
      $this->redirect($this->createUrl('/site/login'));
    } else {
      $s = UserSenha::model()->findByAttributes(array(
        'hash' => $h,
      ));
      if(is_null($s)){
        $this->redirect($this->createUrl('/site/login'));
      } else {
        $model = new AlterarSenhaForm();

        if(isset($_POST['AlterarSenhaForm'])){
          $model->attributes = $_POST['AlterarSenhaForm'];
          if($model->validate()){
            $user = $s->user;
            $user->senha = CPasswordHelper::hashPassword($model->senha);
            if($user->update(array('senha'))){
              HView::fsuc('Senha alterada. Faça login.');
              $s->estado = UserSenha::Usada;
              $s->update(array('estado'));
            } else {
              HView::esuc('Erro ao alterar senha. Faça uma nova solicitação.');
            }
            $this->redirect($this->createUrl('/site/login'));
          }
        }
        $this->render('alterar',['model'=>$model,'h'=>$h,'user'=>$s->user]);
      }
    }
  }

  private function sendEmail($requisicao){
    $msg = 'Solicitação de alteração de senha.<br>';
    $msg .= 'Clique no link abaixo para alterar sua senha.<br><br>';
    $msg .= CHtml::link('Alterar senha','http://'.Yii::app()->params['domain'].'/'.$this->createUrl('/senha/alterar',array('h'=>$requisicao->hash)));
    $msg .= '<br><br><br>';
    $msg .= 'Caso não tenha feito essa solicitação, ignore.';
    HEmail::templateSimples($requisicao->user->email,"Alteração de senha",$msg);
    HView::fsuc('Um email foi enviado para <b>' . $requisicao->user->email . '</b> com o link de alteração de senha.');
  }

  private function getHash($user){
    $fnHash = Yii::app()->params['hashTrocaSenha'];
    return $fnHash($user);
  }

}
