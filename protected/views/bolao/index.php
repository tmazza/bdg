<?php
$jogosPorDia = $bolao->campeonato->jogosPorDia();
foreach ($jogosPorDia as $dia => $jogos) {
  $this->renderPartial('_jogosDoDia',[
    'dia'=>$dia,
    'jogos'=>$jogos,
  ]);
}
?>
