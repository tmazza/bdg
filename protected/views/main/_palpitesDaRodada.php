<h4><?=$bolao->nome;?></h4>
<h5>O prazo para cadastrar os palpites de hoje acabou. Confira os palpites dos usuários participantes:</h5>
<?php foreach ($bolao->participantes as $u):?>
  <?php $jogosNoDia = $bolao->campeonato->jogosNesteDia(time());// TODO: usar o data em bolao_email ?>
  <b><?=$u->nome?></b><br>
  <table border=0 style="width:300px;font-size:12px;">
    <?php foreach ($jogosNoDia as $j): ?>
      <tr>
        <td><?=$j->mandante->nome?></td>
        <td><?php
        $palpite = $j->getPalpiteUserBolao($u->id,$bolao->idBolao);
        if(is_null($palpite)){
          echo ' - x -';
        } else {
          echo $palpite->golsMandante . ' x ' . $palpite->golsVisitante;
        }
        ?></td>
        <td><?=$j->visitante->nome?></td>
      <tr>
    <?php endforeach; ?>
  </table>
<?php endforeach; ?>
<br>
<div style="font-size: 13px;">
- x - Nenhum palpite cadastrado
</div>
