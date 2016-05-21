<?php
$this->renderPartial('_headerBolao',['bolao'=>$bolao]);
$jogosPorDia = $bolao->getJogosEmAberto();
foreach ($jogosPorDia as $dia => $jogos) {
  $this->renderPartial('_jogosDoDia',[
    'bolao'=>$bolao,
    'dia'=>$dia,
    'jogos'=>$jogos,
  ]);
}
?>
