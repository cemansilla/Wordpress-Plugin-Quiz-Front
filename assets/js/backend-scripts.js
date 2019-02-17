(function($){
  $('.preguntas_select').chosen({
    width: "100%"
  });

  $('.quizbook_exam_list_copy_action').click(function(){
    var id_to_copy = 'quizbook_exam_list_shortcode_' + $(this).data('id');

    copyClipboard(id_to_copy);
  });
})(jQuery);

/**
 * Copia el contenido del elemento cuyo id sea pasado como parámetro
 */
function copyClipboard(id_el) {
  var elm = document.getElementById(id_el);
  
  if(document.body.createTextRange) {   // Internet Explorer
    var range = document.body.createTextRange();
    range.moveToElementText(elm);
    range.select();
    document.execCommand("Copy");
    alert("Shortcode copiado");
  }else if(window.getSelection) {       // Other browsers
    var selection = window.getSelection();
    var range = document.createRange();
    range.selectNodeContents(elm);
    selection.removeAllRanges();
    selection.addRange(range);
    document.execCommand("Copy");
    alert("Shortcode copiado");
  }

  // Unselect
  if (window.getSelection) {
    window.getSelection().removeAllRanges();
  } else if (document.selection) {
    document.selection.empty();
  }
}