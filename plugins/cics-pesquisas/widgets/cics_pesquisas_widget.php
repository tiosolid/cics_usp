<?php
/**
 * Widget para exibição de uma lista com as últimas pesquisas do CICS
 *
 * @link https://bitbucket.org/EWTI_WEB/cics_wordpress_app/wiki/pt-br/plugin-eventos
 *
 * @package Cics
 * @subpackage Eventos
 * @since Eventos 1.0
 */

class Cics_Pesquisas_Widget extends WP_Widget {
  //Defaults
  private $number_researches_min = 2;
  const CICS_PESQUISAS_POST_TYPE = 'cics_pesquisas';
  const DEFAULT_TITLE = 'Pesquisas do CICS' ;

  public function __construct() {
    //public function __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
    parent::__construct( 'cics_pesquisas_widget', __( 'Widget de Pesquisas do CICS', 'cics_pesquisas' ),
      array(
  			'classname'   => 'cics_pesquisas_widget',
  			'description' => __( 'Exibe uma lista com as últimas pesquisas do CICS ', 'cics_pesquisas' )
		  )
    );
  }

  //Echoes the widget content
  public function widget($args, $instance) {
    //Defaults
    if (!isset($instance['number_researches'])) { $instance['number_researches'] = $this->number_researches_min; }
    if (!isset($instance['description_text'])) { $instance['description_text'] = ''; }

    $title  = apply_filters( 'widget_title', empty( $instance['title'] ) ? self::DEFAULT_TITLE : $instance['title'], $instance, $this->id_base );
    $number = $instance['number_researches'];
    $description_text = $instance['description_text'];

    $posts = new WP_Query(array(
      'order'          => 'DESC',
      'posts_per_page' => $number,
      'no_found_rows'  => true,
      'post_status'    => 'publish',
      'posts_per_page' => $number,
      'post_type' => self::CICS_PESQUISAS_POST_TYPE,
    ));

    //Print the HTML Output
    echo $args['before_widget'];

    echo '<div class="widget-header">';
    echo $args['before_title'];
    echo $title;
    echo $args['after_title'];
    echo '</div>';

    if ($posts->have_posts()) {
        echo '<div class="widget-links"><nav class="nav-widget-links"><ol>';
        while ($posts->have_posts()) {
            $posts->the_post();

            $post_id = get_the_ID();
            $post_title = get_the_title();
            $post_link = get_the_permalink();

            $post_html = '
                <li id="pesquisa-%s"><a href="%s" title="%s">%s</a></li>
            ';
            $post_html_formatted = sprintf($post_html, $post_id, $post_link, $post_title, $post_title);
            echo $post_html_formatted;
        }
        echo "</ol></nav><p>$description_text</p></div>";
    } else {
      $post_html = '<div class="widget-body"><p><strong>' . _x( 'Nenhuma pesquisa para exibir', 'cics_pesquisas' ) . '</strong></p></div>';
      echo $post_html;
    }
    echo $args['after_widget'];
  }

  //Updates a particular instance of a widget
  public function update($new_instance, $old_instance) {
    $new_instance['title']  = strip_tags( $new_instance['title'] );
    $new_instance['number_researches'] = (intval($new_instance['number_researches']) < 0) ? $this->number_researches_min : absint( $new_instance['number_researches'] );

    return $new_instance;
  }

  //Outputs the settings update form
  public function form($instance) {
    $title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
    $number_researches = (intval($instance['number_researches']) < 0) ? $this->number_researches_min : absint( $instance['number_researches'] );
    $description_text = empty( $instance['description_text'] ) ? '' : esc_attr( $instance['description_text'] );

    $form_html = '
      <p><label for="%s">%s</label>
      <input id="%s" class="widefat" name="%s" type="text" value="%s"></p>
      <p><label for="%s">%s</label>
      <input id="%s" name="%s" type="text" value="%s" size="2" maxlength="2"></p>
      <p class="description">%s</p>
      <p><label for="%s">%s</label>
      <textarea id="%s" class="widefat" name="%s" rows="5">%s</textarea></p>
    ';

    $form_html_formatted = sprintf($form_html,
      esc_attr($this->get_field_id( 'title' )), _x( 'Título:', 'cics_pesquisas' ),
      esc_attr($this->get_field_id('title')), esc_attr( $this->get_field_name('title')), esc_attr($title),
      esc_attr($this->get_field_id('number_researches')),  _x( 'Número de pesquisas a serem exibidas:', 'cics_pesquisas' ),
      esc_attr($this->get_field_id('number_researches')), esc_attr($this->get_field_name('number_researches')), esc_attr($number_researches),
      _x( 'Um valor de 0 (zero) irá listar todas as pesquisas', 'cics_pesquisas' ),
      esc_attr($this->get_field_id('description_text')),  _x( 'Texto de descrição:', 'cics_pesquisas' ),
      esc_attr($this->get_field_id('description_text')), esc_attr($this->get_field_name('description_text')), esc_attr($description_text)
    );

    echo $form_html_formatted;
  }
}
