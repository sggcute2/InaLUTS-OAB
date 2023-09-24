function form_disable_all_fields(m = ''){
  $('.FW___FORM input').attr('disabled', true);
  $('.FW___FORM select').attr('disabled', true);
  $('.FW___FORM textarea').attr('disabled', true);
  $('.FW___FORM button').attr('disabled', true);
  $('.input-group-addon2').hide();
}

function form_disable_all_fields_by_ns(ns = ''){
  $('[name^="'+ns+'"]').attr('disabled', true);
}
