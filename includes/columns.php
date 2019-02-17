<?php
if(!defined('ABSPATH')) exit;

/**
 * Título de columna shortcode en listado
 */
function quizbook_exam_shotcode_column($defaults){
  return array_insert( $defaults, 2, [
    'shortcode' => 'Shortcode',
    'shortcode_copy' => 'Acciones',
  ]);
}
add_filter('manage_exams_posts_columns', 'quizbook_exam_shotcode_column');

/**
 * Valor de columna shortcode en listado
 */
function quizbook_exam_shortcode_column_value($column){
  switch($column){
    case 'shortcode':
      $examen_id = get_the_ID();
      printf('<span id="quizbook_exam_list_shortcode_%1$s">[quizbook_exam preguntas="1" orden="" id="%1$s"]', $examen_id);
    break;
    case 'shortcode_copy':
      $examen_id = get_the_ID();
      printf('</span><a href="javascript:;" class="quizbook_exam_list_copy_action" data-id="%1$s">Copiar shortcode</a>', $examen_id);
    break;
  }
}
add_filter('manage_exams_posts_custom_column', 'quizbook_exam_shortcode_column_value', 5, 1);