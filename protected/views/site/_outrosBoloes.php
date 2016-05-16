<div class="uk-grid">
  <div class="uk-width-medium-2-3 uk-width-small-1-1">
    <table class="uk-table uk-table-condensed uk-table-striped">
      <?php foreach ($boloes as $b):?>
        <tr>
          <td><?=$b->nome;?></td>
          <td>R$ <?=number_format($b->valorInscricao,2,',','.')?></td>
          <td class="uk-text-right">
          <?php
          echo CHtml::link('Participar',$this->createUrl("/pg/comprar/bolao",[
            'id'=>$b->idBolao,
          ]),[
            'class'=>'uk-button uk-button-primary',
            'onclick' => '$(this).html("<i class=\"uk-icon uk-icon-spin uk-icon-spinner\"></i> Redirecionando para o PagSeguro. Aguarde...")',
          ]);
          ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
