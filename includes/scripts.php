<?php
if(!defined('ABSPATH')) exit;

function quizbook_exam_backend_scripts($hook){
  global $post;

  if($hook == 'post-new.php' || $hook == 'post.php' || $hook == 'edit.php'){
    if($post->post_type == 'exams'){
      wp_enqueue_style('chosen_backend_css', plugins_url('../assets/css/chosen.min.css', __FILE__), array(), '1.0.0');
      wp_enqueue_script('chosen_backend_js', plugins_url('../assets/js/chosen.jquery.min.js', __FILE__), array('jquery'), '1.0.0', true);

      wp_enqueue_style('quizbook_exam_backend_css', plugins_url('../assets/css/backend-quizbook_exam.css', __FILE__), array(), '1.0.0');
      wp_enqueue_script('quizbook_exam_backend_js', plugins_url('../assets/js/backend-scripts.js', __FILE__), array(), '1.0.0', true);
    }    
  }
}
add_action('admin_enqueue_scripts', 'quizbook_exam_backend_scripts');