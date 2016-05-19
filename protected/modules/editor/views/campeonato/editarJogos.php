<h3><?=$model->nome;?></h3><br>
<?php foreach ($model->jogos as $j): ?>
  <div class="jogo" data-id='<?=$j->idJogo?>'>
    <?=CHtml::textField('num',$j->numJogo,['style'=>'width:25px',]);?>
    <?=CHtml::textField('data',$j->data,['style'=>'width:135px',]);?>
    <?=CHtml::dropDownList('casa',$j->equipeMandante,$equipes);?>
    <?=CHtml::textField('golsMandante',$j->golsMandante,['style'=>'width:20px',]);?>
    <?=$j->mandante->imagemBrasao('PP')?>
    x
    <?=$j->visitante->imagemBrasao('PP')?>
    <?=CHtml::textField('golsVisitante',$j->golsVisitante,['style'=>'width:20px',]);?>
    <?=CHtml::dropDownList('vist',$j->equipeVisitante,$equipes);?>
    <button onclick='atualizaJogo($(this).parent())' class="uk-button uk-button-primary">Atualizar</button>
  </div>
  <br>
<?php endforeach; ?>
<script>
function atualizaJogo(elem){
  var id = elem.attr('data-id');
  var num = elem.find('[name=num]').val();
  var data = elem.find('[name=data]').val();
  var casa = elem.find('[name=casa]').val();
  var vist = elem.find('[name=vist]').val();
  var gMan = elem.find('[name=golsMandante]').val();
  var gVis = elem.find('[name=golsVisitante]').val();
  $.ajax({
    url: "<?=$this->createUrl('/editor/campeonato/updateJogo')?>",
    cache: false,
    type: 'POST',
    data: { id:id,numJogo:num,data:data,equipeMandante:casa,equipeVisitante:vist,golsMandante:gMan,golsVisitante:gVis},
    beforeSend: function(){
      elem.find('button').text("Aguarde...");
    },
  }).done(function( html ) {
    if(html == 'OK'){
      alert('Atualizado');
      elem.find('button').text("Atualizar");
    } else {
      alert('Não foi possível atualizar');
      elem.find('button').text("*** Atualize a página");
    }

  });
}
</script>
