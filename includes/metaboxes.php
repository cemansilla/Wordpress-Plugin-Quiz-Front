<?php
if(!defined('ABSPATH')) exit;

/**
 * Agrego metabox al CPT quizes
 */
function quizbook_exam_add_metaboxes(){
  add_meta_box('quizbook_exam_meta_box', 'Preguntas del examen', 'quizbook_exam_metaboxes', 'exams', 'normal', 'high', null);
}
add_action('add_meta_boxes', 'quizbook_exam_add_metaboxes');

/**
 * Contenido / formulario del CPT exámenes
 */
function quizbook_exam_metaboxes($post){
  wp_nonce_field(basename(__FILE__), 'quizbook_exam_nonce');
  ?>
  <table class="form-table">
    <tr>
      <th class="row-title" colspan="2">
        <h2>Selecciona las respuestas para que se incluyan en el exámen</h2>
      </th>
    </tr>
    <tr>
      <th class="row-title">
        <label for="">Selecciona de la lista</label>
      </th>
      <td>
        <?php
        $args = array(
          "post_type" => "quizes",
          "posts_per_page" => -1
        );
        $preguntas = get_posts($args);
        if(count($preguntas)){
          $wpdb_value = get_post_meta($post->ID, 'quizbook_examen', true);
          $seleccionadas = maybe_unserialize($wpdb_value);
          if(empty($seleccionadas)){ $seleccionadas = array(); }
          ?>
          <select data-placeholder="Escoja las preguntas..." class="preguntas_select" multiple tabindex="4" name="quizbook_exam_preguntas[]">
            <option value=""></option>
            <?php foreach($preguntas as $p): ?>
            <option <?php echo (in_array($p->ID, $seleccionadas)) ? 'selected' : ''; ?> value="<?php echo $p->ID; ?>"><?php echo $p->post_title; ?></option>
            <?php endforeach; ?>
          </select>
          <?php
        }else{
          $link_new = admin_url( 'post-new.php?post_type=quizes');
          printf('<p class="qb_warning">Comienza por agregar preguntas en Quiz Book &gt;&gt; <a href="%1$s">Agregar</a></p>', $link_new);
        }
        ?>
      </td>
    </tr>
  </table>
  <?php
}

/**
 * Almacenamiento de metaboxes de exámenes
 */
function quizbook_exam_save_metaboxes($post_id, $post, $update){
  // Validación de seguridad con nonce
  if(!isset($_POST['quizbook_exam_nonce']) || !wp_verify_nonce($_POST['quizbook_exam_nonce'], basename(__FILE__))){
    return $post_id;
  }

  // Validación de seguridad con permisos de usuario
  if(!current_user_can('edit_post', $post_id)){
    return $post_id;
  }

  // Validación de seguridad evitando autoguardado
  if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
    return $post_id;
  }
  
  $respuestas = '';
  if(isset($_POST["quizbook_exam_preguntas"])){
    $respuestas = $_POST["quizbook_exam_preguntas"];

    $a_respuestas = array();
    foreach($respuestas as $r){
      $a_respuestas[] = sanitize_text_field($r);
    }

    update_post_meta($post_id, 'quizbook_examen', maybe_serialize($a_respuestas));
  }
}
add_action('save_post', 'quizbook_exam_save_metaboxes', 10, 3);