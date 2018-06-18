<?php
class HTime {

  public static function get() {
    $ajuste = -109;
    return time() + $ajuste;
  }

}