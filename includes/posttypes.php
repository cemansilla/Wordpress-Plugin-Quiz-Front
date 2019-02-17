<?php
if(!defined('ABSPATH')) exit;

/**
 * CPT de Exámenes
 */
function quizbook_exam_post_type() {
  $labels = array(
      'name'                  => _x( 'Exámen', 'Post type general name', 'quizbook' ),
      'singular_name'         => _x( 'Exámen', 'Post type singular name', 'quizbook' ),
      'menu_name'             => _x( 'Exámenes', 'Admin Menu text', 'quizbook' ),
      'name_admin_bar'        => _x( 'Exámen', 'Add New on Toolbar', 'quizbook' ),
      'add_new'               => __( 'Agregar nuevo', 'quizbook' ),
      'add_new_item'          => __( 'Agregar nuevo Exámen', 'quizbook' ),
      'new_item'              => __( 'Nuevo Exámen', 'quizbook' ),
      'edit_item'             => __( 'Editar Exámen', 'quizbook' ),
      'view_item'             => __( 'Ver Exámen', 'quizbook' ),
      'all_items'             => __( 'Todos Exámenes', 'quizbook' ),
      'search_items'          => __( 'Buscar Exámenes', 'quizbook' ),
      'parent_item_colon'     => __( 'Padre Exámenes:', 'quizbook' ),
      'not_found'             => __( 'No encontrados.', 'quizbook' ),
      'not_found_in_trash'    => __( 'No encontrados.', 'quizbook' ),
      'featured_image'        => _x( 'Imagen Destacada', '', 'quizbook' ),
      'set_featured_image'    => _x( 'Añadir imagen destacada', '', 'quizbook' ),
      'remove_featured_image' => _x( 'Borrar imagen', '', 'quizbook' ),
      'use_featured_image'    => _x( 'Usar como imagen', '', 'quizbook' ),
      'archives'              => _x( 'Exámenes Archivo', '', 'quizbook' ),
      'insert_into_item'      => _x( 'Insertar en Exámen', '', 'quizbook' ),
      'uploaded_to_this_item' => _x( 'Cargado en este Exámen', '', 'quizbook' ),
      'filter_items_list'     => _x( 'Filtrar Exámenes por lista', '”. Added in 4.4', 'quizbook' ),
      'items_list_navigation' => _x( 'Navegación de Exámenes', '', 'quizbook' ),
      'items_list'            => _x( 'Lista de Exámenes', '', 'quizbook' ),
  );

  $args = array(
      'labels'             => $labels,
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'exams' ),
      'capability_type'    => array('exam', 'exams'),
      'menu_position'      => 7,
      'menu_icon'          => 'dashicons-welcome-write-blog',
      'has_archive'        => false,
      'hierarchical'       => false,
      'supports'           => array( 'title'),
      'map_meta_cap'       => true
  );

  register_post_type( 'exams', $args );
}
add_action( 'init', 'quizbook_exam_post_type' );

/**
 * Flush rewrite
 * Simula la actualización de permalinks
 */
function quizbook_exam_rewrite_flush(){
  quizbook_exam_post_type();
  flush_rewrite_rules();
}