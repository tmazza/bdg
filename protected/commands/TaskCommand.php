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
      $id = 'UPDATES_BRASILEIRO_A_2016';
      $lastHash = $this->getLastPage($id);
      $html = $this->parserHTML->file_get_html('http://www.cbf.com.br/competicoes/brasileiro-serie-a/alteracoes-de-jogos/2016');
      $hash = hash('sha512',$html->plaintext);

      if($lastHash == $hash){
        $this->saveLog("UP_BRASILEIRO_A_2016 Sem alterações");
      } else {
        $divs = $html->find('div');
        $divsAlts = [];
        foreach ($divs as $d) {
          if(strlen($d->id) > 9 && strpos($d->id,'alteracao') !== false){
            $divsAlts[] = $d;
          }
        }
        $alteacoes = [];
        foreach ($divsAlts as $d) {
          # Busca numero do jogo
          $blocoNumJogo = $d->find('.small',0)->innertext;
          $numeros = [];
          preg_match_all('/[0-9]{1,3}/',$blocoNumJogo,$numeros);
          $numJogo = $numeros[0][0];

          # Busca nova data e novo horário
          $table = $d->find('table',0);
          $data = $table->find('tr',2)->find('td',2)->plaintext;
          $hora = $table->find('tr',3)->find('td',2)->plaintext;

          $alteacoes[] = [
            'jogo'=>$numJogo,
            'data'=>$data,
            'hora'=>$hora,
          ];
        }
        # salva como já realizada!
        $this->hashAntigo[$id] = $hash;
        $this->setLastPage();
        $this->saveLog("UP_BRASILEIRO_A_2016 Encontradas " . count($alteacoes) . " posíveis alterações");
      }
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
      return isset($this->hashAntigo[$id]) ? $this->hashAntigo[$id] : false;
    }

    /**
     * Grava lista de hash já analisados
     */
    private function setLastPage(){
      $handle = fopen($this->filename,'a+');
      fwrite($handle,json_encode($this->hashAntigo));
      fclose($handle);
    }

}
