<h3><?=$bolao->nome;?></h3>
<?php
if($bolao->isUserPendente()){
  $this->renderPartial('/site/_inscricaoPendente',[
    'b'=>$bolao,
  ]);
}
$jogosPorDia = $bolao->campeonato->jogosPorDiaEmAberto();
foreach ($jogosPorDia as $dia => $jogos) {
  $this->renderPartial('_jogosDoDia',[
    'bolao'=>$bolao,
    'dia'=>$dia,
    'jogos'=>$jogos,
  ]);
}
?>
