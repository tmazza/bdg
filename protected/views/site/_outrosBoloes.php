<div class="uk-grid">
  <div class="uk-width-medium-2-3 uk-width-small-1-1">
    <table class="uk-table uk-table-condensed uk-table-striped">
      <tr>
        <th>Bolão</th>
        <th>Valor inscrição</th>
        <th></th>
      </tr>
      <?php foreach ($boloes as $b):?>
        <tr>
          <td><?=$b->nome;?></td>
          <?php if($b->tipoInscricao == Bolao::TipoPago): ?>
            <td>
              <span class="uk-badge uk-badge-notification uk-badge-success">
                R$ <?=number_format($b->valorInscricao,2,',','.')?>
              </span>
            </td>
            <td class="uk-text-right">
              <?php
              echo CHtml::link('Participar',$this->createUrl("/pg/comprar/bolao",[
                'id'=>$b->idBolao,
              ]),[
                'class'=>'uk-button uk-button-primary',
                'data-uk-tooltip'=>'',
                'title'=>'Através do PagSeguro',
                'onclick' => '$(this).html("<i class=\"uk-icon uk-icon-spin uk-icon-spinner\"></i> Redirecionando para o PagSeguro. Aguarde...")',
              ]);
              ?>
            </td>
          <?php else: ?>
            <td>
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
