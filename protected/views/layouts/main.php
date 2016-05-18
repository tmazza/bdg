<?php $this->beginContent('application.views.layouts.base'); ?>
<div class="uk-container uk-container-center">
  <?php HView::flashMessages(); ?>
  <div class="md-card">
    <?=$content;?>
  </div>
</div>
<?php $this->endContent(); ?>
