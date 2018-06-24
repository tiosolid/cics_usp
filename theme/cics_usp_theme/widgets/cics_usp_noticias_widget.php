<?php
/**
 * Widget para exibição de uma lista com as últimas notícias do CICS
 *
 * @link https://bitbucket.org/EWTI_WEB/cics_wordpress_app/wiki/pt-br/especificacoes-tema
 *
 * @package Cics
 * @subpackage Usp
 * @since Usp 1.0
 */

class Cics_Usp_Noticias_Widget extends WP_Widget {
  //Defaults
  private $number_posts_min = 2;
  const POST_TYPE = 'post';
  const DEFAULT_TITLE = 'Notícias' ;

  public function __construct() {
    //public function __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
    parent::__construct( 'cics_usp_noticias_widget', __( 'Widget de Notícias do CICS', 'cics_usp' ),
      array(
  			'classname'   => 'cics_usp_noticias_widget',
  			'description' => __( 'Exibe uma lista com as últimas notícias do CICS ', 'cics_usp' )
		  )
    );
  }

  //Echoes the widget content
  public function widget($args, $instance) {
    //Defaults
    if (!isset($instance['number_posts'])) { $instance['number_posts'] = $this->number_posts_min; }

    $title  = apply_filters( 'widget_title', empty( $instance['title'] ) ? self::DEFAULT_TITLE : $instance['title'], $instance, $this->id_base );
    $number = $instance['number_posts'];

    $posts = new WP_Query(array(
      'order'          => 'DESC',
      'posts_per_page' => $number,
      'no_found_rows'  => true,
      'post_status'    => 'publish',
      'posts_per_page' => $number,
      'post_type' => self::POST_TYPE,
    ));

    $archive_link_html_formatted = null;
	$archive_url = get_category_link (1);
	if (strlen($archive_url) > 0) {
	  //echo '<div class="col-md-12"><p class="text-right">'. sprintf(_x('See All The %s', 'cics_usp'), $title) .'</p></div>';
	  $archive_link_html =  '
		<span class="widget-archives pull-right">
			<a href="%s" class="link-ver-mais">%s</a>
		</span>
	  ';
	  $archive_link_html_formatted = sprintf($archive_link_html, $archive_url, _x('ver mais >>', 'cics_usp'));
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
            <div class="widget-body" id="noticia-%s">
				<span class="widget-post-date">%s</span>
                <h3 class="widget-subtitle"><a href="%s">%s</a></h3>
                <div class="widget-title-underline"></div>
                <p>%s</p>
            </div>
        ';
        $post_html_formatted = sprintf($post_html, $post_id, $post_time, $post_link, $post_title, $post_excerpt);
        echo $post_html_formatted;
      }
    } else {
      $post_html = '<div class="widget-body"><p><strong>' . _x( 'Nenhuma notícia para exibir', 'cics_usp' ) . '</strong></p></div>';
      echo $post_html;
    }
    echo $args['after_widget'];
  }

  //Updates a particular instance of a widget
  public function update($new_instance, $old_instance) {
    $new_instance['title']  = strip_tags( $new_instance['title'] );
    $new_instance['number_posts'] = empty( $new_instance['number_posts'] ) ? 3 : absint( $new_instance['number_posts'] );

    return $new_instance;
  }

  //Outputs the settings update form
  public function form($instance) {
    $title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
    $number_posts = empty( $instance['number_posts'] ) ? $this->number_posts_min : absint( $instance['number_posts'] );

    $form_html = '
      <p><label for="%s">%s</label>
      <input id="%s" class="widefat" name="%s" type="text" value="%s"></p>
      <p><label for="%s">%s</label>
      <input id="%s" name="%s" type="text" value="%s" size="1"></p>
    ';

    $form_html_formatted = sprintf($form_html,
      esc_attr($this->get_field_id( 'title' )), _x( 'Title:', 'cics_usp' ),
      esc_attr($this->get_field_id('title')), esc_attr( $this->get_field_name('title')), esc_attr($title),
      esc_attr($this->get_field_id('number_posts')),  _x( 'Número de notícias a serem exibidas:', 'cics_usp' ),
      esc_attr($this->get_field_id('number_posts')), esc_attr($this->get_field_name('number_posts')), esc_attr($number_posts)
    );

    echo $form_html_formatted;
  }
}
