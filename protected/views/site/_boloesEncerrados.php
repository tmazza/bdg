  <br>
  <div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <h3>Bolões encerrados</h3>
    <div class="uk-grid">
      <?php foreach ($boloesEncerrados as $b): ?>
          <div class="uk-width-medium-1-3 uk-width-large-1-4 uk-width-small-1-2">
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
          </div>
      <?php endforeach; ?>
    </div>
  </div>