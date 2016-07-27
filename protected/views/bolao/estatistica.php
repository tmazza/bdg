<?php $this->renderPartial('_headerBolao',['bolao'=>$bolao]); ?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable(<?=$pontosPorRodada?>);

    var options = {
      title: '',
      // curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
  }
</script>

<h5 class="uk-text-center"><b>Pontos distribuídos por rodada</b></h5>
<div id="curve_chart" style="width: 100%"></div>

<hr>
<br>
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
