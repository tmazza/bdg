<table class="uk-table">
  <?php foreach ($campeonatos as $c): ?>
    <tr>
      <td><?=$c->codigo;?></td>
      <td><?=$c->nome;?></td>
      <td>
        <?=CHtml::link('Editar',$this->createUrl('/editor/campeonato/editar',['id'=>$c->codigo]),[
            'class' => 'uk-button',
          ])?>
        <?=CHtml::link('Editar jogos',$this->createUrl('/editor/campeonato/editarJogos',['id'=>$c->codigo]),[
            'class' => 'uk-button',
          ])?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
