<?php if($qtdOutros>0): ?>
  <?php $this->renderPartial('_outrosBoloes',['boloes'=>$outrosBoloes]); ?>
<?php endif; ?>

<?php if($qtdInscritos>0): ?>
  <br>
  <div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <h3>Bolões inscrito</h3>
    <div class="uk-grid">
      <?php foreach ($this->user->boloesInscritos as $b): ?>
        <div class="uk-width-medium-1-3 uk-width-small-1-1">
          <a href='<?=$this->createUrl('/bolao/index',['id'=>$b->idBolao]);?>'>
            <div class="uk-thumbnail uk-thumbnail-expand">
                <?php if(!is_null($b->capa)): ?>
                  <img src="<?=$b->capa;?>" alt="Imagem <?=$b->nome?>">
                <?php endif; ?>
                <div class="uk-thumbnail-caption">
                  <h3><?=$b->nome;?></h3>
                </div>
            </div>
          </a>
          <?php if($b->isUserPendente()){
            $this->renderPartial('_inscricaoPendente',[
              'b'=>$b,
            ]);
          } ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>
