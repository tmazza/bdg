<div class="uk-panel uk-panel-box" >
  <h4><?=HView::tradDia(date('l, d/m',$dia));?></h4>
  <div>
    <hr>
    <table class="uk-table uk-table-condensed">
      <tr>
        <th class="uk-hidden-small">Horário</th>
        <th class="uk-text-center-small uk-text-right">Mandante</th>
        <th class="uk-hidden-small"></th>
        <th class="uk-text-center-small">Visitante</th>
      </tr>
      <?php foreach ($jogos as $j): ?>
        <?php
        list($jGolsMandante,$jGolsVisitante) = $j->getGolsFechado();
        ?>
        <tr style="border-top:4px solid #eee;important;">
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
            <span class='uk-badge uk-text-large' style="background:#85BAE6">
              <?=is_null($jGolsMandante) ? '' : $jGolsMandante;?>
            </span>
          </td>
          <td class="uk-text-center uk-hidden-small" style="width:8px;background:#eee;">x</td>
          <td style="width:;" class="uk-text-left">
            <span class='uk-badge uk-text-large' style="background:#85BAE6">
              <?=is_null($jGolsVisitante) ? '' : $jGolsVisitante;?>
            </span>
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
          </td>
        </tr>
        <?php
        list($golsMandante,$golsVisitante) = $j->getGolsPalpiteUserBolao($bolao);
        ?>
        <tr>
          <td class="uk-hidden-small"></td>
          <td class="uk-text-right">
            <div class='uk-float-left'>
              Sua aposta:
            </div>
            <span class='uk-badge uk-badge-notification uk-text-large' style="background:grey">
              <?=is_null($golsMandante)?'':$golsMandante;?>
            </span>
          </td>
          <td class="uk-text-center uk-hidden-small" style="width:8px;background:#eee;"></td>
          <td style="width:;" class="uk-text-left">
            <span class='uk-badge uk-badge-notification uk-text-large'  style="background:grey">
              <?=is_null($golsVisitante)?'':$golsVisitante;?>
            </span>
          </td>
        </tr>
        <tr>
          <td class="uk-hidden-small"></td>
          <td class="uk-text-right" colspan="3">
            <div class='uk-float-left'>
              Pontos conquistados:
            </div>
            <b><?=$j->getPontosObtidos($bolao);?></b>
          </td>
        </tr>
        <tr><td colspan="4"><br></td></tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
<br>
