<?php
class TaskCommand extends MainCommand
{
    public function __construct(){
      parent::__construct();
      $this->filename = $this->baseDir.'/hashs.json';
      $this->logFilename = $this->baseDir.'/logs.txt';
    }

    public function actionCheckUpdates() {
      $this->atualizacoesBrasileiroA2016();
    }

    private function atualizacoesBrasileiroA2016(){
      $id = 'BRA16';
      $lastHash = $this->getLastPage($id);
      $html = $this->parserHTML->file_get_html('http://www.cbf.com.br/competicoes/brasileiro-serie-a/alteracoes-de-jogos/2016');
      $hash = hash('sha512',$html->find('.col-md-9',0)->plaintext);

      if($lastHash == $hash){
        $this->saveLog("{$id} Sem alterações");
      } else {
        $divs = $html->find('div');
        $divsAlts = [];
        foreach ($divs as $d) {
          if(strlen($d->id) > 9 && strpos($d->id,'alteracao') !== false){
            $divsAlts[] = $d;
          }
        }

        $pagesHash = $this->getHashPages($id);

        $alteracoes = [];
        foreach ($divsAlts as $d) {
          $hashPage = hash('sha512',$d->innertext);
          if(!in_array($hashPage,$pagesHash)){
            $pagesHash[] = $hashPage;
            # Busca numero do jogo
            $titulo = $d->find('h4',0)->innertext;
            $blocoNumJogo = $d->find('.small',0)->innertext;
            $numeros = [];
            preg_match_all('/[0-9]{1,3}/',$blocoNumJogo,$numeros);
            $numJogo = $numeros[0][0];

            # Busca nova data e novo horário
            $table = $d->find('table',0);
            $dataDe = $table->find('tr',2)->find('td',1)->plaintext;
            $horaDe = $table->find('tr',3)->find('td',1)->plaintext;
            $dataPara = $table->find('tr',2)->find('td',2)->plaintext;
            $horaPara = $table->find('tr',3)->find('td',2)->plaintext;

            $motivo = $table->find('tr',5)->find('td',1)->plaintext;

            $alteracoes[] = [
              'codCampeonato'=>$id,
              'descricao'=>$titulo,
              'numJogo'=>$numJogo,
              'de'=>$dataDe . ' - ' . $horaDe,
              'para'=>$dataPara . ' - ' . $horaPara,
              'motivo'=>$motivo,
            ];
          }
        }
        if($this->registraPendencia($alteracoes)){
          # salva como já realizada!
          $this->hashAntigo[$id] = [
            'hash'=>$hash,
            'paginas'=>$pagesHash,
          ];
          $this->setLastPage();
          $msg = "{$id} Encontradas " . count($alteracoes) . " posíveis alterações";
          $this->saveLog($msg);
          HEmail::toAdminNoTemplate("Atualizações aguardando avaliação.",$msg . (count($alteracoes)==0?'**Somente pág. alterada.Sem Alterações nos jogos.':''));
        } else {
          $this->saveLog('ERRO AO SALVAR ALTERACOES: ' . $msg);
        }
      }
    }

    private function registraPendencia($alteracoes){
      $ok = true;
      foreach ($alteracoes as $a) {
        $model = new Alteracao();
        $model->data = HTime::get();
        $model->attributes = $a;
        $ok = $model->save() && $ok;
      }
      return $ok;
    }

}
