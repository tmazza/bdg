<div class="uk-panel uk-panel-box uk-panel-box-secondary">
  <h3>Bolões disponíveis</h3>
  <div class="uk-grid">
    <div class="uk-width-medium-2-3 uk-width-small-1-1">
      <table class="uk-table uk-table-condensed uk-table">
        <tr>
          <th></th>
          <th class="uk-text-right">Valor da inscrição</th>
          <th></th>
        </tr>
        <?php foreach ($boloes as $b):?>
          <tr>
            <td><?=$b->nome;?></td>
            <?php if($b->tipoInscricao == Bolao::TipoPago): ?>
              <td  class="uk-text-right">
                <span class="uk-badge uk-badge-notification uk-badge-success">
                  R$ <?=number_format($b->valorInscricao,2,',','.')?>
                </span>
              </td>
              <td class="uk-text-right">
                <?php
                echo CHtml::link('Participar',$this->createUrl("/bolao/inscricaoPaga",[
                  'id'=>$b->idBolao,
                ]),[
                  'class'=>'uk-button uk-button-primary',
                ]);
                ?>
              </td>
            <?php else: ?>
              <td class="uk-text-right">
                <span class="uk-badge uk-badge-notification uk-badge-success">
                  Gratuito
                </span>
              </td>
              <td class="uk-text-right">
                <?php
                echo CHtml::link('Participar',$this->createUrl("/bolao/inscricaoGratuita",[
                  'id'=>$b->idBolao,
                ]),[
                  'class'=>'uk-button uk-button-primary',
                ]);
                ?>
              </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
