<?php
/**
 * Widget para exibição do bloco CICS Facts
 *
 * @link https://bitbucket.org/EWTI_WEB/cics_wordpress_app/wiki/pt-br/especificacoes-tema
 *
 * @package Cics
 * @subpackage Usp
 * @since Usp 1.0
 */

class Cics_Usp_Facts_Widget extends WP_Widget {
  //Defaults
  const DEFAULT_TITLE = 'CICS Facts' ;

  public function __construct() {
    //public function __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
    parent::__construct( 'cics_usp_facts_widget', __( 'Widget do bloco CICS Facts', 'cics_usp' ),
      array(
  			'classname'   => 'cics_usp_facts_widget',
  			'description' => __( 'Exibe um bloco com o contéudo do CICS Facts', 'cics_usp' )
		  )
    );
  }

  //Echoes the widget content
  public function widget($args, $instance) {
    //Defaults
    $title  = apply_filters( 'widget_title', empty( $instance['title'] ) ? self::DEFAULT_TITLE : $instance['title'], $instance, $this->id_base );

    //Print the HTML Output
    echo $args['before_widget'];

    echo '<div class="widget-header">';
    echo $args['before_title'];
    echo $title;
    echo $args['after_title'];
    echo '</div>';

	echo '
		<div class="widget-facts-numbers">
			<div class="row">
				<div class="col-left col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<span>Criado em</span>
					<span><strong>2014</strong></span>
				</div>

				<div class="col-right col-lg-7 col-md-7 col-sm-7 col-xs-7">
					<span><strong>650</strong>m² de retrofit</span>
					<span><strong>650</strong>m² de construção nova</span>
					<span><strong>1.280</strong>m² de área</span>
				</div>
			</div>
		</div>
	';

    echo $args['after_widget'];
  }

  //Updates a particular instance of a widget
  public function update($new_instance, $old_instance) {
    $new_instance['title']  = strip_tags( $new_instance['title'] );

    return $new_instance;
  }

  //Outputs the settings update form
  public function form($instance) {
    $title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );

    $form_html = '
      <p><label for="%s">%s</label>
      <input id="%s" class="widefat" name="%s" type="text" value="%s"></p>
    ';

    $form_html_formatted = sprintf($form_html,
      esc_attr($this->get_field_id( 'title' )), _x( 'Title:', 'cics_usp' ),
      esc_attr($this->get_field_id('title')), esc_attr( $this->get_field_name('title')), esc_attr($title)
    );

    echo $form_html_formatted;
  }
}
