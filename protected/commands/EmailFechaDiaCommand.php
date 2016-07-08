<?php
class EmailFechaDiaCommand extends MainCommand
{

  public function __construct(){
    parent::__construct();
    $this->logFilename = $this->baseDir.'/logs-emailDoDia.txt';
  }

  public function actionIndex() {
    $this->alimentaFila();
    $this->consomeFila();
  }

  private function alimentaFila(){
    $boloes = Bolao::model()->findAll(); # TODO: buscar somente bolões ativos
    foreach ($boloes as $b) {
      if(is_null($b->emailDoDia)){
        if($b->isDiaFechado()){
          $this->saveLog("Bolão {$b->idBolao} Dia fechado e emails não enviados \\o/");

          $bolaoEmail = new BolaoEmail();
          $bolaoEmail->idBolao = $b->idBolao;
          $bolaoEmail->dia = date('Y-m-d');
          if($bolaoEmail->save()){

            if($b->campeonato->temJogosHoje()){
              $participantes = $b->participantes;
              foreach ($participantes as $u) {
                if($u->emailFechaDia){
                  $model = new FilaEmail();
                  $model->idUsuario = $u->id;
                  $model->email = $bolaoEmail->id;
                  $model->foi = 0;
                  if(!$model->save()){
                    $bolaoEmail->delete();
                    $this->saveLog("Erro ao salvar fila de email para U:{$u->id}");
                    HEmail::toAdmin("Erro ao salvar fila de email para U:{$u->id} D:".date('d/m/Y'));
                  } else {
                    $this->saveLog("Add na fila U:{$u->id} EMAIL:{$bolaoEmail->id}");
                  }
                }
              }
            } else {
              $this->saveLog("Dias sem jogos :(");
            }
          } else {
            $this->saveLog("Erro ao salvar registro em bolao_dia B:{$v->idBolao}}");
            HEmail::toAdmin("Erro ao salvar registro em bolao_dia B:{$v->idBolao}} D:".date('d/m/Y'));
          }
        }
      }
    }
  }

  private function consomeFila(){
    $naoEnviados = FilaEmail::model()->findAll([
      'condition'=>'foi=0',
      'limit'=>20,
    ]);
    $bodyPath = Yii::getPathOfAlias('application.views.main').'/_palpitesDaRodada.php';
    $msgPath = Yii::getPathOfAlias('application.views.main').'/_emailBasico.php';
    foreach ($naoEnviados as $e) {
      $bolao = $e->bolaoEmail->bolao;
      $controller = new CController('SiteController');
      $msg = $controller->renderInternal($bodyPath,['bolao' => $bolao,],true);
      $content = $controller->renderInternal($msgPath,['msg' => $msg,],true);
      HEmail::noTemplate($e->user->email,"Fechamento do dia " . date('d/m/Y'),$content);
      $e->foi = 1;
      $e->data = time();
      $e->update(['foi','data']);
    }
  }

}
