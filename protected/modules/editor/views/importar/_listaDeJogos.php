<h3>Jogos identificados <div class="uk-badge"><?=count($jogos)?></div></h3>
<table class="uk-table">
  <tr><th>Rodada</th><th>Nº<br>jogo</th><th>Data</th><th>Hora</th><th>Casa</th><th>Visitante</th></tr>
  <?php foreach ($jogos as $k=>$j): ?>
    <tr>
      <td><?=$j['RODADA'] ?></td>
      <td><?=$j['NUM'] ?></td>
      <td><?=$j['DATA']?></td>
      <td><?=$j['HORA']?></td>
      <td><?=(isset($equipes[$j['CASA']]) ? $equipes[$j['CASA']]->nome : '?')?></td>
      <td><?=(isset($equipes[$j['VISITANTE']]) ? $equipes[$j['VISITANTE']]->nome : '?')?></td>
    </tr>
  <?php endforeach; ?>
</table>
<?=CHtml::beginForm($this->createUrl('/editor/importar/salvar'),'POST',['class'=>'uk-form']);?>
  <?=CHtml::hiddenField('jogos',json_encode($jogos));?>
  <?=CHtml::dropDownList('campeonato',null,$campeonatos);?>
  <button type="submit" class="uk-button uk-button-primary">Salvar jogos</button>
<?=CHtml::endForm();?>
<br>
<hr>
<br>
