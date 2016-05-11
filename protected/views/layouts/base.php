<!DOCTYPE html>
<html lang='pt'>
    <?php $this->renderPartial('//layouts/head'); ?>
    <body>

      <?=$content;?>

      <?php $this->renderPartial('//layouts/footer'); ?>

      <!-- modal ajax multi uso :) -->
      <div id="main-modal" class="uk-modal uk-animation-scale">
        <div class="uk-modal-dialog">
          <a class="uk-modal-close uk-close"></a>
          <div class="content"><div class="uk-modal-spinner"></div></div>
        </div>
      </div>
      <div id="main-modal-large" class="uk-modal uk-animation-scale-up">
        <div class="uk-modal-dialog uk-modal-dialog-large">
          <a class="uk-modal-close uk-close"></a>
          <div class="content"><div class="uk-modal-spinner"></div></div>
        </div>
      </div>

  </body>
</html>
