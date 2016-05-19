<h3>Alterações</h3>
<table class="uk-table uk-table-condensed uk-table-striped">
  <tr>
    <th>codCampeonato</th>
    <th>numJogo</th>
    <th>de</th>
    <th>para</th>
    <th>descricao</th>
    <th>motivo</th>
    <th>data</th>
    <th></th>
  <tr>
  <?php foreach ($alteracoes as $a): ?>
    <tr>
      <td><?=$a->codCampeonato?></td>
      <td><?=$a->numJogo?></td>
      <td><?=$a->de?></td>
      <td><?=$a->para?></td>
      <td><?=$a->descricao?></td>
      <td><?=$a->motivo?></td>
      <td>Em <?=date('d/m/Y H:i:s')?></td>
      <td><?php
      if($a->status == Alteracao::StatusFechada){
        echo '-';
      } else {
        echo CHtml::link("done",$this->createUrl("/editor/alteracao/fechar",['id'=>$a->id]),[
          'class'=>'uk-button uk-button-success'
        ]);
      }
      ?></td>
    <tr>
  <?php endforeach; ?>
</table>
