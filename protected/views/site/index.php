<?php if(count($boloesNaoInscritos)>0): ?>
  <?php $this->renderPartial('/site/_outrosBoloes',['boloes'=>$boloesNaoInscritos]); ?>
<?php endif; ?>

<?php if(count($boloesInscritos) > 0): ?>
  <?php $this->renderPartial('/site/_boloesInscrito',['boloesInscritos'=>$boloesInscritos]); ?>
<?php endif; ?>

<?php if(count($boloesEncerrados) > 0): ?>
  <?php $this->renderPartial('/site/_boloesEncerrados',['boloesEncerrados'=>$boloesEncerrados]); ?>
<?php endif; ?>
