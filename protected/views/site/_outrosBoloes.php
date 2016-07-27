<div class="uk-panel uk-panel-box uk-panel-box-secondary">
  <h3>Bolões disponíveis</h3>
  <div class="uk-grid">     
    <?php foreach ($boloes as $b):?>
        <div class="uk-width-medium-1-3 uk-width-large-1-4 uk-width-small-1-2">
          <div class="uk-thumbnail uk-thumbnail-expand">
            <?php if(!is_null($b->capa)): ?>
              <img src="<?=$b->capa;?>" alt="Imagem <?=$b->nome?>">
            <?php endif; ?>
            <div class="uk-thumbnail-caption">
              <h3><?=$b->nome;?></h3>

              <div class="uk-text-left">
                <?=CHtml::ajaxLink("Regulamento",$this->createUrl('/regulamento/bolao',[
                  'id'=>$b->idBolao,
                ]),HView::modalUpdate('main-modal-large'),[
                  'class'=>'uk-button uk-button-link'
                ]); ?>
              </div>
              <hr>
              <span class="uk-badge uk-badge-notification uk-badge-success uk-float-left">
              Valor inscrição: 
                <?php if($b->tipoInscricao == Bolao::TipoPago){
                  echo 'R$ ' . number_format($b->valorInscricao,2,',','.');
                  $url='/bolao/inscricaoPaga';
                } else {
                  echo 'Gratuito';
                  $url='/bolao/inscricaoGratuita';
                } ?>
              </span>
              <?= CHtml::link('Participar',$this->createUrl($url,[
                'id'=>$b->idBolao,
              ]),[
                'class'=>'uk-button uk-button-primary uk-float-right',
              ]); ?>
            </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

