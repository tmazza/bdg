<?php if($qtdOutros>0): ?>
  <?php $this->renderPartial('_outrosBoloes',['boloes'=>$outrosBoloes]); ?>
<?php endif; ?>

<?php if($qtdInscritos>0): ?>
  <br>
  <div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <h3>Bolões inscrito</h3>
    <ul class="uk-list uk-list-striped">
      <?php
      foreach ($this->user->boloesInscritos as $b) {
        echo '<li>';
        if($b->isUserPendente()){
          $this->renderPartial('_inscricaoPendente',[
            'b'=>$b,
          ]);
        }
        echo CHtml::link($b->nome,$this->createUrl('/bolao/index',['id'=>$b->idBolao]),[
          'class'=>'uk-button uk-button-link'
        ]);
        echo '</li>';
      }
      ?>
    </ul>
  </div>
<?php endif; ?>
