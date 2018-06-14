<h4><?=$bolao->nome;?></h4>
<h5>O prazo para cadastrar os palpites de hoje acabou. Confira os palpites dos usuários participantes:</h5>

<?php
# TODO: usar o data em bolao_email
$jogosNoDia = $bolao->campeonato->jogosNesteDia(time());
?>
<table border=0 style="font-size:12px;">
  <tr>
    <td></td>
    <?php foreach ($jogosNoDia as $j): ?>
      <td style="text-align: center;background: #abeaff">
        <?=$j->mandante->abreviacao?>
        x
        <?=$j->visitante->abreviacao?>
      </td>
    <?php endforeach; ?>
  </tr>

  <?php foreach ($bolao->participantes as $k => $u):?>
    <?php if($k % 2 == 0): ?>
    <tr>
    <?php else: ?>
    <tr style="background: #f0f0f0;">
    <?php endif; ?>
      <td><b><?=$u->nome?></b></td>
      <?php foreach ($jogosNoDia as $j): ?>
        <td style="text-align: center;">
          <?php
          $palpite = $j->getPalpiteUserBolao($u->id,$bolao->idBolao);
          if(is_null($palpite)){
            echo ' <small style="color:#888">-</small>';
          } else {
            echo $palpite->golsMandante . ' x ' . $palpite->golsVisitante;
          }
          ?>
        </td>
      <?php endforeach; ?>
    </tr>
  <?php endforeach; ?>
</table>
<br>
<div style="font-size: 13px;">
- Nenhum palpite cadastrado
</div>
