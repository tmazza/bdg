<?php $this->renderPartial('_headerBolao',['bolao'=>$bolao]); ?>
<div class="uk-grid">
  <div class='uk-width-medium-7-10 uk-width-small-1-1'>
    <?php if(count($resultados['placares']) > 0): ?>

      <div class="uk-grid">
        <!-- RESULTADOS  -->
        <div class="uk-width-1-2">
          <?php $total = $resultados['total'] > 0 ? $resultados['total'] : 1; ?>
          <table class="uk-table uk-table-striped uk-table-condensed">

            <tr>
              <th class="uk-text-center" colspan="3">Resultados mais frequentes</th>    
            </tr>
            <tr>
              <td class="uk-text-center">Casa x Vistante</td>    
              <td class="uk-text-right uk-hidden-small">Ocorrências</td>    
              <td class="uk-text-right">
                <span class="uk-hidden-small">Frequência</span>
                <span class="uk-visible-small">Freq.</span>
              </td>    
            </tr>
            <?php foreach($resultados['placares'] as $p => $f): ?>
              <tr>
                <td class="uk-text-center"><?=$p?></td>    
                <td class="uk-text-right uk-hidden-small"><?=$f?></td>    
                <td class="uk-text-right"><?=number_format($f/$total*100,1,',','.')?>%</td>    
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <!-- PALPITES -->
        <?php
        // Ordem por quantidade de ocorrencias
        uasort($palpites['placares'],function($a,$b){
          return $a['q']<$b['q'];
        });
        ?>
        <div class="uk-width-1-2">
          <?php $total = $palpites['totalQtd'] > 0 ? $palpites['totalQtd'] : 1; ?>
          <table class="uk-table uk-table-striped uk-table-condensed">
            <tr>
              <th class="uk-text-center" colspan="3">Palpites mais frequentes</th>    
            </tr>
            <tr>
              <td class="uk-text-center">Casa x Vistante</td>    
              <td class="uk-text-right uk-hidden-small">Ocorrências</td>    
              <td class="uk-text-right">
                <span class="uk-hidden-small">Frequência</span>
                <span class="uk-visible-small">Freq.</span>
              </td>    
            </tr>
            <?php foreach($palpites['placares'] as $p => $d): ?>
              <tr>
                <td class="uk-text-center"><?=$p?></td>    
                <td class="uk-text-right uk-hidden-small"><?=$d['q']?></td>    
                <td class="uk-text-right"><?=number_format($d['q']/$total*100,1,',','.')?>%</td>    
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    <?php else: ?>
      <br>
      <div class="uk-alert" style="margin: 0 auto;font-size: 18px;line-height: 26px;max-width: 320px;">
        <b>Mais informações após o resultado do primeiro jogo.</b><br>
      </div>
    <?php endif; ?>
   
  </div>
  <div class='uk-width-medium-3-10 uk-hidden-small'>
    <?php $this->renderPartial('_menu',[
      'bolao' => $bolao,
    ]); ?>
  </div>
</div>