  <br>
  <div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <h3>Bolões encerrados</h3>
    <ul class="">
      <?php foreach ($boloesEncerrados as $b): ?>
          <li>
            <a href='<?=$this->createUrl('/bolao/index',['id'=>$b->idBolao]);?>'>
              <?=$b->nome;?>
            </a>
          </li>
      <?php endforeach; ?>
    </ul>
  </div>