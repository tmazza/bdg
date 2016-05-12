<?php
class ImportaJogos extends CFormModel {

  public $formato;
  public $jogos;

  public function rules(){
    return [
      ['formato,jogos','required'],
      ['formato','validateFormato']
    ];
  }

  public function validateFormato($attribute,$params){
    $partes = preg_split('/\s+/', $this->$attribute);
    $obrigatorios = ['DATA','HORA','CASA','VISITANTE'];
    foreach ($obrigatorios as $o) {
      if(!in_array($o,$partes)){
        $this->addError($attribute,'Informe a posição de: ' . $o);
      }
    }
  }

  /**
   * Retorna lista de jogos separados por DATA,HORA,CASA e VISITANTE, processando
   * $jogos de acordo com o $formato definido
   */
  public function aplicaFormato(){
    $partes = preg_split('/\s+/', trim($this->formato));
    $posicao = array_flip($partes);

    $linhas = preg_split('/[\n]/', $this->jogos);

    $lista = [];
    foreach ($linhas as $l) {
      $coluna = preg_split('/\s+/', trim($l));
      if(count($coluna) == count($partes)){
        $lista[] = [
          'DATA' => $coluna[$posicao['DATA']],
          'HORA' => $coluna[$posicao['HORA']],
          'CASA' => $coluna[$posicao['CASA']],
          'VISITANTE' => $coluna[$posicao['VISITANTE']],
        ];
      }
    }
    return $lista;
  }


}
