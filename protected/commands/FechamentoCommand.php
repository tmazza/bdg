<?php
class FechamentoCommand extends MainCommand
{

  public function __construct(){
    parent::__construct();
    $this->filename = $this->baseDir.'/hashs-fechamento.json';
    $this->logFilename = $this->baseDir.'/logs-fechamento.txt';
  }

  public function actionIndex() {
    $this->jogosFechadosBrasileiroA2016V2();
    //$this->jogosFechadosBrasileiroA2016(); // # site cbf
  }

  private function jogosFechadosBrasileiroA2016V2(){
    $id = 'BRA16';
    $lastHash = $this->getLastPage($id);
    $html = $this->parserHTML->file_get_html('http://www.tabeladobrasileirao.net/');
    $hash = hash('sha512',$html->find('table',0)->plaintext);
    if($lastHash == $hash){
      $this->saveLog("{$id} Sem alterações");
    } else {
      $linhas = $html->find('table tbody',0)->find('tr');
      $jogos = [];
      foreach ($linhas as $l) {
       $colunas = $l->find('td');
       if(count($colunas) > 0){
         $data = $l->find('td',1)->plaintext;
         if(substr_count($data,'/') > 0){
           $primeiraColuna = $l->find('td',0);

           $casa = $primeiraColuna->find('.home_name',0)->title;
           $visi = $primeiraColuna->find('.visitor_name',0)->title;

           $placarCasa = $primeiraColuna->find('.game-scoreboard-input',0)->plaintext;
           $placarVisi = $primeiraColuna->find('.game-scoreboard-input',2)->plaintext;
           $placar = str_replace('&nbsp;','',$placarCasa) . ' x ' . str_replace('&nbsp;','',$placarVisi);
           
           $jogos[] = [ 
             'numJogo' => '?',
             'dataHora' => $data . '/2016 - ' . $l->find('td',3)->plaintext,
             'casa' => $casa,
             'visitante' => $visi,
             'placar' => $placar,
           ];
         }
       }
      }
      $this->interpretaJogosEncontrados($id,$jogos);
      $this->hashAntigo[$id] = [
           'hash'=>$hash,
           'paginas'=>[],
       ];
      $this->setLastPage();
      $this->saveLog('Alterações processadas');
    }
  }

  private function jogosFechadosBrasileiroA2016(){
    $id = 'BRA16';
    $lastHash = $this->getLastPage($id);
    $html = $this->parserHTML->file_get_html('http://www.cbf.com.br/competicoes/brasileiro-serie-a/tabela/2016');
    #$html = $this->parserHTML->file_get_html('http://www.cbf.com.br/competicoes/brasileiro-serie-a');
    $hash = hash('sha512',$html->find('.col-md-9',0)->plaintext);
    if($lastHash == $hash){
      $this->saveLog("{$id} Sem alterações");
    } else {
      $linhas = $html->find('.col-md-9 .table-condensed',0)->find('tr');
      $jogos = [];
      foreach ($linhas as $l) {
        $colunas = $l->find('td');
        if(count($colunas) > 0){
          $jogos[] = [
            'numJogo' => $l->find('td',0)->innertext,
            'dataHora' => $l->find('td',2)->innertext,
            'casa' => $l->find('td',3)->innertext,
            'placar' => $l->find('td',4)->innertext,
            'visitante' => $l->find('td',5)->innertext,
          ];
        }
      }
      $this->interpretaJogosEncontrados($id,$jogos);
      $this->hashAntigo[$id] = [
         'hash'=>$hash,
         'paginas'=>[],
      ];
      $this->setLastPage();
      $this->saveLog('Alterações processadas');
    }
  }

  /**
   * Entrada: lista de jogos no formato.
   * numJogo: qualquer | identificador do jogo usado nos logs
   * dataHora: d/m/Y - H:i
   * casa: string | equipe visitante usa levenshtein para match com equipe cadastrada
   * placara: "int x int" ou " x "
   * visitante: string | equipe visitante usa levenshtein para match com equipe cadastrada
   */
  private function interpretaJogosEncontrados($id,$jogos){
    $erros = $atualizados = [];
    foreach ($jogos as $j) {
      $placar = str_replace(' ','',$j['placar']);
      if(strlen($placar)>2){

        $equipes = Equipe::model()->findAll();
        $timeCasa = $this->getIdTime($equipes,$j['casa']);
        $timeVisi = $this->getIdTime($equipes,$j['visitante']);

        if($timeCasa && $timeVisi){
          list($data,$hora) = explode(' - ',$j['dataHora']);
          list($d,$m,$y) = explode('/',$data);
          list($h,$i) = explode(':',$hora);
          $data = "$y-$m-$d $h:$i:00";

          $jogo = Jogo::model()->findByAttributes([
            'data'=>$data,
            'equipeMandante'=>$timeCasa->id,
            'equipeVisitante'=>$timeVisi->id,
            'codCampeonato'=>$id,
          ]);
          if(is_null($jogo)){
             $time = strtotime($data);
	     if($time > HTime::get()-48*60*60){
		 $erros[] = HView::removeAcentos("Jogo nao encontrado. " . $j['casa'] . ':'
                                 . $timeCasa->id . 'x' . $j['visitante'] . ':'
                                 . $timeVisi->id . ' | numJogo: ' . $j['numJogo']
                                 . 'Data: ' . $data);
	     }
          } else {
            $dataJogo = strtotime($jogo->data);
            if($jogo->status != Jogo::StatusFechado && $dataJogo < HTime::get()){
              list($golsCasa,$golsVisi) = explode('x',$placar);

              if($golsCasa != (int)$golsCasa){ # Controle de caracteres não numéricos que zerariam o num gols
                $erros[] = 'Num gosl casa inválido. IdJogo: ' . $jogo->idJogo;
              } elseif($golsVisi != (int)$golsVisi){ # Controle de caracteres não numéricos que zerariam o num gols
                $erros[] = 'Num gosl visi inválido. IdJogo: ' . $jogo->idJogo;
              } else {
                $comAlteracoes = false;
                if(is_null($jogo->golsMandante) || $jogo->golsMandante != (int)$golsCasa){
                  $jogo->golsMandante = (int)$golsCasa;
                  $comAlteracoes = true;
                }
                if(is_null($jogo->golsVisitante) || $jogo->golsVisitante != (int)$golsVisi){
                  $jogo->golsVisitante = (int)$golsVisi;
                  $comAlteracoes = true;
                }
                if($comAlteracoes){
                  $jogo->status = Jogo::StatusEmAberto;
                  $jogo->update(['golsMandante','golsVisitante','status']);
                  $atualizados[]=[$jogo->idJogo=>HView::removeAcentos($jogo->mandante->nome).'x'.HView::removeAcentos($jogo->visitante->nome)];
                }
              }
            }
          }
        } else {
          $erros[] = "Equipe nao encontrada. " . $j['casa'] . 'x'
                                . $j['visitante'] . ' | numJogo: ' . $j['numJogo'];
        }
      }
    }

    if(count($erros)>0){
      $msg = '<pre>' . json_encode($erros) . '</pre>';
      HEmail::toAdminNoTemplate("Possíveis erros ao atualaziar resultado de jogos.",$msg);
    }
    if(count($atualizados)>0){
      $msg = '<pre>' . json_encode($atualizados) . '</pre>';
      HEmail::toAdminNoTemplate(count($atualizados) . " jogo(s) atualizados.",$msg);
    }
  }

  private function getIdTime($equipes,$time){
    $menor = strlen($time) + 100;
    $equipe = false;
    foreach ($equipes as $e) {
      $calc = levenshtein(str_replace(' ','',$e->nome),str_replace(' ','',$time));
      if($calc < $menor){
        $menor = $calc;
        $equipe = $e;
      }
    }
    return $equipe;
  }

}
