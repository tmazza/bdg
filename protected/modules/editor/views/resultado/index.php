<h3>Campeonatos</h3>
<?php
foreach ($campeonatos as $c) {
  echo CHtml::link($c->nome,$this->createUrl('/editor/resultado/rodadas',[
    'id'=>$c->codigo,
  ]));
  echo '<br>';
}
