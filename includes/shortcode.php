<?php
if(!defined('ABSPATH')) exit;

/**
 * Funcionalidad de shortcode
 * Modo de uso:  [quizbook_exam preguntas="1" orden="" id=""]
 */
function quizbook_exam_shortcode( $atts ) {
  // Valores por defecto
  $preguntas = (isset($atts["preguntas"])) ? $atts["preguntas"] : 5;
  $orderby = (isset($atts["orden"])) ? $atts["orden"] : 'date';
  $examen_id = (int)$atts['id'];

  $preguntas = maybe_unserialize(get_post_meta($examen_id, 'quizbook_examen', true));

  $args = array(
    "post_type" => "quizes",
    "posts_per_page" => $preguntas,
    "orderby" => $orderby,
    "post__in" => $preguntas
  );
  $quizbook = new WP_Query($args);

  ob_start();
  ?>
  <form name="quizbook_enviar" id="quizbook_enviar">
    <div id="quizbook" class="quizbook">
      <ul>
        <?php while($quizbook->have_posts()): $quizbook->the_post(); ?>
        <li>
          <?php the_title('<h2>', '</h2>'); ?>
          <?php the_content(); ?>
          <?php
          $opciones = get_post_meta(get_the_ID());
          foreach($opciones as $k => $v){
            if(quizbook_filter_questions($k) === 0){
              $a_tmp = explode("_", $k);
              $numero = end($a_tmp);
              ?>
              <div id="<?php echo get_the_ID() . ":" . $numero; ?>" class="respuesta">
                <?php echo $v[0]; ?>
              </div>
              <?php
            }
          }
          ?>
        </li>
        <?php endwhile; wp_reset_postdata(); ?>
      </ul>
    </div>
    <div id="quizbook_resultado"></div>
    <input type="submit" value="Enviar" id="quizbook_btn_submit">
  </form>
  <?php
  $html = ob_get_contents();
  ob_end_clean();

  return $html;
}
add_shortcode( 'quizbook_exam', 'quizbook_exam_shortcode' );