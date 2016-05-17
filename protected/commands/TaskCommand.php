<?php
class TaskCommand extends CConsoleCommand
{
    private $baseDir;
    private $filename;
    private $logFilename;
    private $hashAntigo = false;
    private $parserHTML;

    public function __construct(){
      $this->baseDir = __DIR__.'/../runtime/commands';
      if(!is_dir($this->baseDir))
        mkdir($this->baseDir,0777);

      $this->filename = $this->baseDir.'/hashs.json';
      $this->logFilename = $this->baseDir.'/logs.txt';
      $this->parserHTML = new SimpleHTMLDOM();
    }

    public function actionIndex() { echo "\o/ \n";  }

    public function actionCheckUpdates() {
      $this->atualizacoesBrasileiroA2016();
    }

    private function atualizacoesBrasileiroA2016(){
      $id = 'BRA16';
      $lastHash = $this->getLastPage($id);
      $html = $this->parserHTML->file_get_html('http://www.cbf.com.br/competicoes/brasileiro-serie-a/alteracoes-de-jogos/2016');
      $hash = hash('sha512',$html->plaintext);

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
        $model->data = time();
        $model->attributes = $a;
        $ok = $model->save() && $ok;
      }
      return $ok;
    }

    /**
     * Salva mensagem em arquivo de log
     */
    private function saveLog($msg){
      $handle = fopen($this->logFilename,'a+');
      fwrite($handle,date("d/m/Y H:i:s") . ' ' . $msg . "\n");
      fclose($handle);
    }

    /**
     * Retorna últumo hash de página processado. Se o arquivo ainda não existe
     * ou $id nunca foi processado retorna false
     */
    private function getLastPage($id){
      if(!$this->hashAntigo && file_exists($this->filename)){
        $handle = fopen($this->filename,'r');
        $this->hashAntigo = json_decode(fread($handle,filesize($this->filename)),true);
        fclose($handle);
      }
      return isset($this->hashAntigo[$id]) ? $this->hashAntigo[$id]['hash'] : false;
    }

    /**
     * Retorna os hashs das páginas/blocos já processado.
     */
    private function getHashPages($id){
      if(!$this->hashAntigo && file_exists($this->filename)){
        $handle = fopen($this->filename,'r');
        $this->hashAntigo = json_decode(fread($handle,filesize($this->filename)),true);
        fclose($handle);
      }
      return isset($this->hashAntigo[$id]) ? $this->hashAntigo[$id]['paginas'] : [];
    }


    /**
     * Grava lista de hash já analisados
     */
    private function setLastPage(){
      $handle = fopen($this->filename,'w+');
      fwrite($handle,json_encode($this->hashAntigo));
      fclose($handle);
    }

}
