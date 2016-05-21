<?php
$this->renderPartial('_headerBolao',['bolao'=>$bolao]);
$jogosPorDia = $bolao->getJogosFechados();
foreach ($jogosPorDia as $dia => $jogos) {
  $this->renderPartial('_jogosFechados',[
    'dia'=>$dia,
    'jogos'=>$jogos,
    'bolao'=>$bolao,
  ]);
}
?>
