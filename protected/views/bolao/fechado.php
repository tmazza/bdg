<h3><?=$bolao->nome;?></h3>
<?php
if($bolao->isUserPendente()){
  $this->renderPartial('/site/_inscricaoPendente',[
    'b'=>$bolao,
  ]);
}
$jogosPorDia = $bolao->campeonato->jogosPorDiaFechados();
foreach ($jogosPorDia as $dia => $jogos) {
  $this->renderPartial('_jogosFechados',[
    'dia'=>$dia,
    'jogos'=>$jogos,
    'bolao'=>$bolao,
  ]);
}
?>
