<?php
$this->renderPartial('_headerBolao',['bolao'=>$bolao]);
$jogosPorDia = $bolao->campeonato->jogosPorDiaFechados();
foreach ($jogosPorDia as $dia => $jogos) {
  $this->renderPartial('_jogosFechados',[
    'dia'=>$dia,
    'jogos'=>$jogos,
    'bolao'=>$bolao,
  ]);
}
?>
