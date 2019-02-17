<?php
if(!defined('ABSPATH')) exit;

/*
Plugin Name:  Quiz Book exámenes
Plugin URI:
Description:  Agrega posibilidad de crear exámenes para tus Quiz (Addon)
Version:      1.0
Author:       Cesar Mansilla
Author URI:
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  quizbook
*/

/**
 * Valida que exista el plugin principal
 */
function quizbook_exam_check(){
  if(!function_exists('quizbook_post_type')){
    add_action('admin_notices', 'quizbook_exam_error_on_activate');

    deactivate_plugins(plugin_basename(__FILE__));
  }
}
add_action('admin_init', 'quizbook_exam_check');

/**
 * Mensaje de error en caso de no tener el plugin principal
 */
function quizbook_exam_error_on_activate(){
  $clase = 'notice notice-error';
  $mensaje = 'Ha ocurrido un error. Es necesario tener instalado el plugin <strong>Quiz Book</strong>';
  printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($clase), $mensaje);
}

/**
 * Agrego post type de exámenes
 */
require_once(plugin_dir_path(__FILE__) . "includes/posttypes.php");

/**
 * Agrego capabilities, el rol ya existe por el plugin principal
 */
require_once(plugin_dir_path(__FILE__) . "includes/roles.php");
register_activation_hook( __FILE__, 'quizbook_exam_add_capabilities' );
register_deactivation_hook( __FILE__, 'quizbook_exam_remove_capabilities' );

/**
 * Agrego metaboxes al CPT de exámenes
 */
require_once(plugin_dir_path(__FILE__) . "includes/metaboxes.php");

/**
 * Agrego css y js
 */
require_once(plugin_dir_path(__FILE__) . "includes/scripts.php");

/**
 * Agrego shortcode
 */
require_once(plugin_dir_path(__FILE__) . "includes/shortcode.php");

/**
 * Agrego código de shortcode como columna en el listado ed exámenes
 */
require_once(plugin_dir_path(__FILE__) . "includes/columns.php");