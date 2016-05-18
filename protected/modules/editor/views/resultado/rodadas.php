<?php foreach ($dias as $d => $jogos): ?>
  <?=date('d/m/Y',$d)?><br><br>
  <?=CHtml::beginForm();?>
    <input type="hidden" name='dia' value='<?=$d?>' />
    <table class="uk-table uk-table-striped uk-table-condensed">
      <tr>
        <th>Rodada</th>
        <th>Mandante</th>
        <th>Placar</th>
        <th>Visitante</th>
      </tr>
      <?php $ok = true; ?>
      <?php foreach ($jogos as $j): ?>
          <tr>
            <td style="width:10px;"><?=$j->rodada?></td>
            <td style="width:150px;"><?=$j->mandante->nome?></td>
            <td style="width:100px;">
              <?=is_null($j->golsMandante)?'<i class="uk-icon uk-icon-spin uk-icon-question"></i>':$j->golsMandante;?>
              x
              <?=is_null($j->golsVisitante)?'<i class="uk-icon uk-icon-spin uk-icon-question"></i>':$j->golsVisitante;?>
              <?php
              if(is_null($j->golsMandante) || is_null($j->golsVisitante)){
                $ok = false;
              }
              ?>
            </td>
            <td><?=$j->visitante->nome?></td>
          </tr>
      <?php endforeach; ?>
        <tr><td colspan="3">
          <?php if($ok): ?>
            <?=CHtml::submitButton("Processar rodada",['class'=>'uk-button uk-button-primary'])?>
          <?php else: ?>
            <div class='uk-alert'>Aguardando resultado de jogo(s)</div>
          <?php endif; ?>
        </td><td></td></tr>
    </table>
  <?=CHtml::endForm();?>
  <br><br><hr>
<?php endforeach; ?>
