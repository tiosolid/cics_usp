<?php
/**
 * Widget para exibição de uma lista com os últimos eventos do CICS
 *
 * @link https://bitbucket.org/EWTI_WEB/cics_wordpress_app/wiki/pt-br/plugin-eventos
 *
 * @package Cics
 * @subpackage Eventos
 * @since Eventos 1.0
 */

class Cics_Eventos_Widget extends WP_Widget {
  //Defaults
  private $number_events_min = 2;
  const CICS_EVENTOS_POST_TYPE = 'cics_eventos';
  const DEFAULT_TITLE = 'Eventos do CICS' ;

  public function __construct() {
    //public function __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
    parent::__construct( 'cics_eventos_widget', __( 'Widget de Eventos do CICS', 'cics_eventos' ),
      array(
  			'classname'   => 'cics_eventos_widget',
  			'description' => __( 'Exibe uma lista com os últimos eventos do CICS ', 'cics_eventos' )
		  )
    );
  }

  //Echoes the widget content
  public function widget($args, $instance) {
    //Defaults
    if (!isset($instance['number_events'])) { $instance['number_events'] = $this->number_events_min; }

    $title  = apply_filters( 'widget_title', empty( $instance['title'] ) ? self::DEFAULT_TITLE : $instance['title'], $instance, $this->id_base );
    $number = $instance['number_events'];

    $posts = new WP_Query(array(
      'order'          => 'DESC',
      'posts_per_page' => $number,
      'no_found_rows'  => true,
      'post_status'    => 'publish',
      'posts_per_page' => $number,
      'post_type' => self::CICS_EVENTOS_POST_TYPE,
    ));

    $archive_link_html_formatted = null;
    $archive_url = get_post_type_archive_link(self::CICS_EVENTOS_POST_TYPE);
    if ($archive_url) {
      //echo '<div class="col-md-12"><p class="text-right">'. sprintf(_x('See All The %s', 'cics_eventos'), $title) .'</p></div>';
      $archive_link_html =  '
        <span class="widget-archives pull-right">
            <a href="%s" class="link-ver-mais">%s</a>
        </span>
      ';
      $archive_link_html_formatted = sprintf($archive_link_html, $archive_url, _x('ver mais >>', 'cics_eventos'));
    }

    //Print the HTML Output
    echo $args['before_widget'];

    echo $args['before_title'];
    echo $title;
    echo $archive_link_html_formatted;
    echo $args['after_title'];

    if ($posts->have_posts()) {
      while ($posts->have_posts()) {
        $posts->the_post();

        $post_id = get_the_ID();
        $post_title = get_the_title();
        $post_link = get_the_permalink();
        $post_excerpt = get_the_excerpt();
        $post_time = get_the_date('d.m.y');

        $post_html = '
            <div class="widget-body" id="evento-%s">
                <span class="widget-post-date">%s</span>
                <h3 class="widget-subtitle"><a href="%s">%s</a></h3>
                <span class="widget-title-underline"></span>
                <p>%s</p>
            </div>
        ';
        $post_html_formatted = sprintf($post_html, $post_id, $post_time, $post_link, $post_title, $post_excerpt);
        echo $post_html_formatted;
      }
    } else {
      $post_html = '<div class="widget-body"><p><strong>' . _x( 'Nenhum evento para exibir', 'cics_eventos' ) . '</strong></p></div>';
      echo $post_html;
    }
    echo $args['after_widget'];
  }

  //Updates a particular instance of a widget
  public function update($new_instance, $old_instance) {
    $new_instance['title']  = strip_tags( $new_instance['title'] );
    $new_instance['number_events'] = empty( $new_instance['number_events'] ) ? 3 : absint( $new_instance['number_events'] );

    return $new_instance;
  }

  //Outputs the settings update form
  public function form($instance) {
    $title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
    $number_events = empty( $instance['number_events'] ) ? $this->number_events_min : absint( $instance['number_events'] );

    $form_html = '
      <p><label for="%s">%s</label>
      <input id="%s" class="widefat" name="%s" type="text" value="%s"></p>
      <p><label for="%s">%s</label>
      <input id="%s" name="%s" type="text" value="%s" size="1"></p>
    ';

    $form_html_formatted = sprintf($form_html,
      esc_attr($this->get_field_id( 'title' )), _x( 'Title:', 'cics_eventos' ),
      esc_attr($this->get_field_id('title')), esc_attr( $this->get_field_name('title')), esc_attr($title),
      esc_attr($this->get_field_id('number_events')),  _x( 'Número de eventos a serem exibidos:', 'cics_eventos' ),
      esc_attr($this->get_field_id('number_events')), esc_attr($this->get_field_name('number_events')), esc_attr($number_events)
    );

    echo $form_html_formatted;
  }
}
