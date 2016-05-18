<?php
class MainCommand extends CConsoleCommand
{
  protected $baseDir;
  protected $filename;
  protected $logFilename;
  protected $hashAntigo = false;
  protected $parserHTML;

  public function __construct(){
    $this->baseDir = __DIR__.'/../runtime/commands';
    if(!is_dir($this->baseDir))
    mkdir($this->baseDir,0777);
    $this->parserHTML = new SimpleHTMLDOM();
  }

  /**
   * Salva mensagem em arquivo de log
   */
  protected function saveLog($msg){
    $handle = fopen($this->logFilename,'a+');
    fwrite($handle,date("d/m/Y H:i:s") . ' ' . $msg . "\n");
    fclose($handle);
  }

  /**
   * Retorna últumo hash de página processado. Se o arquivo ainda não existe
   * ou $id nunca foi processado retorna false
   */
  protected function getLastPage($id){
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
  protected function getHashPages($id){
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
  protected function setLastPage(){
    $handle = fopen($this->filename,'w+');
    fwrite($handle,json_encode($this->hashAntigo));
    fclose($handle);
  }

}
