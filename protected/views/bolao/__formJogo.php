<div id='dia-<?=$dia?>'>
  <table class="uk-table uk-table-condensed">
    <tr>
      <th class="uk-hidden-small">Horário</th>
      <th class="uk-text-center-small uk-text-right">Mandante</th>
      <th class="uk-hidden-small"></th>
      <th class="uk-text-center-small">Visitante</th>
    </tr>
    <?php foreach ($jogos as $j): ?>
      <?php
      list($golsMandante,$golsVisitante) = $j->getGolsPalpiteUserBolao($bolao);
      ?>
      <tr>
        <td style="width:40px;" class="uk-hidden-small"><?=substr($j->data,11,5)?></td>
        <td class="uk-text-right">
          <span class="uk-hidden-small">
            <?=$j->mandante->nome;?>
            <?=$j->mandante->imagemBrasao('P')?>
          </span>
          <span class="uk-visible-small">
            <?=$j->mandante->abreviacao;?>
            <span data-uk-tooltip title="<?=$j->mandante->nome;?>">
              <?=$j->mandante->imagemBrasao('P')?>
            </span>
          </span>
          <input value="<?=$golsMandante?>" name='<?=$j->idJogo?>[casa]' style="width:30px;text-align:center;" numerical />
        </td>
        <td class="uk-text-center uk-hidden-small" style="width:8px;background:#eee;">x</td>
        <td style="width:;" class="uk-text-left">
          <input value="<?=$golsVisitante?>" name='<?=$j->idJogo?>[visi]' style="width:30px;text-align:center;" numerical />
          <span class="uk-hidden-small">
            <?=$j->visitante->imagemBrasao('P')?>
            <?=$j->visitante->nome;?>
          </span>
          <span class="uk-visible-small">
            <span data-uk-tooltip title="<?=$j->visitante->nome;?>">
              <?=$j->visitante->imagemBrasao('P')?>
            </span>
            <?=$j->visitante->abreviacao;?>
          </span>
          <?php if($j->complemento): ?>
            <div class="uk-float-right">
              <?php if($j->complemento == Jogo::SerieA): ?>
                <span class="uk-badge uk-badge-success">A</span>
              <?php endif; ?>
              <?php if($j->complemento == Jogo::SerieB): ?>
                <span class="uk-badge uk-badge-danger">B</span>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
