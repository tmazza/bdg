<?php
class HView {

  public static function flashMessages(){
    $u = Yii::app()->user;
    $base = function($classe,$msg) use ($u){
      return  '<div class="uk-alert '.$classe.'" title="Fechar" onclick="$(this).remove();"><a href="#!" class="uk-alert-close uk-close"></a>' . $u->getFlash($msg) . '</div>';
    };
    if($u->hasFlash(MainController::fsuc)){ echo $base('uk-alert-success',MainController::fsuc); }
    if($u->hasFlash(MainController::ferr)){ echo $base('uk-alert-danger',MainController::ferr); }
    if($u->hasFlash(MainController::finf)){ echo $base('uk-alert-warning',MainController::finf); }
  }

  public static function fsuc($msg){
    Yii::app()->user->setFlash(MainController::fsuc,$msg);
  }
  public static function ferr($msg){
    Yii::app()->user->setFlash(MainController::ferr,$msg);
  }
  public static function finf($msg){
    Yii::app()->user->setFlash(MainController::finf,$msg);
  }

  /**
   * Caso var seja maior que 1 o sufixo de plural é retornado
   * @param type $teste
   * @param type $sufixo
   * @return type
   */
  public static function hasPlural($qtd, $sufixoSim = 's', $sufixoNao = '') {
      return $qtd > 1 ? $sufixoSim : $sufixoNao;
  }


  public static function toUrl($str){
    $str = str_replace(' ','-',str_replace('  ',' ',$str));
    $str = preg_replace('[\.|,|;|\/]','',$str);
    return self::paraBusca($str);
  }

  /**
   * Remove acentos de string
   * @param type $str
   * @return type
   */
  public static function removeAcentos($str) {
      // assume $str esteja em UTF-8
      $map = array(
          'á' => 'a', 'à' => 'a', 'ã' => 'a', 'â' => 'a', 'é' => 'e', 'ê' => 'e', 'í' => 'i', 'ó' => 'o',
          'ô' => 'o', 'õ' => 'o', 'ú' => 'u', 'ü' => 'u', 'ç' => 'c', 'Á' => 'A', 'À' => 'A', 'Ã' => 'A',
          'Â' => 'A', 'É' => 'E', 'Ê' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ú' => 'U',
          'Ü' => 'U', 'Ç' => 'C'
      );
      return strtr($str, $map);
  }

  /**
   * Normaliza string para busca
   * @param type $str
   * @return type
   */
  public static function paraBusca($str) {
      return strtolower(HView::removeAcentos($str));
  }

  public static function modalUpdate($modal='main-modal'){
    return [
      'beforeSend' => 'js:function(){
         $("#'.$modal.' .content").html("<div class=\"uk-text-center\"><i class=\"uk-icon-spin uk-icon-spinner uk-icon-large\"></i></div>");
         $("#'.$modal.' .content").focus();
         UIkit.modal("#'.$modal.'").show();
      }',
      'success' => 'js: function(html) {
        $("#'.$modal.' .content").html(html);
      }',
    ];
  }

}
