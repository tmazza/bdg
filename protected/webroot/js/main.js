 function salvaPalpite(id) {
   var $dia = $('#dia-' + id);
   var $status = $('#status-' + id);
   $.ajax({
     beforeSend: fnBeforeSend,
     success: fnSuccess,
     error: fnError,
     type: 'POST',
     dataType: 'json',
     url: '/bolao/salvaPalpite',
     cache: false,
     data: $dia.parents("form").serialize(),
   });


  function fnBeforeSend() {
    $dia.find('input').prop('disabled', true);
    var icon = "<i class='uk-icon uk-icon-spin uk-icon-spinner'></i>";
    var msg = "<div class='uk-alert'>" + icon + " Atualizando aguarde...</div>";
    $status.html(msg);
  };
  function fnSuccess(res) {
    if(res.save) {
      $dia.find('input').prop('disabled', false);
      var icon = "<i class='uk-icon uk-icon-check'></i>";
      var msg = "<div class='uk-alert uk-alert-success'>" + icon + " Palpite atualizado.</div>";
      $status.html(msg);
    } else {
      $dia.find('input').prop('disabled', false);
      fnError();
    }
  };
  function fnError() {
    var icon = "<i class='uk-icon uk-icon-times'></i>";
    var msg = "<div class='uk-alert uk-alert-danger'>" + icon;
        msg += " Erro ao salvar palpite. Verifique os valores informados e tente novamente.</div>";
    $status.html(msg);
  };

  return false;
 }