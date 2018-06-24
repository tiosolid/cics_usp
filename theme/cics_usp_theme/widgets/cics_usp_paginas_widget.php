<?php
/**
 * Widget para exibição do resumo (excerpt) de uma página do site
 *
 * @link https://bitbucket.org/EWTI_WEB/cics_wordpress_app/wiki/pt-br/especificacoes-tema
 *
 * @package Cics
 * @subpackage Usp
 * @since Usp 1.0
 */

class Cics_Usp_Paginas_Widget extends WP_Widget {
  //Defaults
  const DEFAULT_PRIMARY_LINK_TEXT = 'Conheça o CICS';
  const DEFAULT_SECONDARY_LINK_TEXT = 'Conheça o CICS Living Lab';
  const DEFAULT_TITLE = 'Widget de Resumo de Página';
  const DEFAULT_TEXT = 'Esse Widget deve ser configurado na administração para exibir o resumo de uma página do site';

  public function __construct() {
    //public function __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
    parent::__construct( 'cics_usp_paginas_widget', __( 'Widget de Resumo de Páginas', 'cics_usp' ),
      array(
  			'classname'   => 'cics_usp_paginas_widget',
  			'description' => __( 'Exibe o resumo (excerpt) de uma página do sistema, além de links customizados no final do texto', 'cics_usp' )
		  )
    );
  }

  //Echoes the widget content
  public function widget($args, $instance) {
    //Defaults
    if (!isset($instance['primary_link_text'])) { $instance['primary_link_text'] = self::DEFAULT_PRIMARY_LINK_TEXT; }
	if (!isset($instance['secondary_link_text'])) { $instance['secondary_link_text'] = self::DEFAULT_SECONDARY_LINK_TEXT; }
	if (!isset($instance['primary_page_id'])) { $instance['primary_page_id'] = 0; }
	if (!isset($instance['secondary_page_id'])) { $instance['secondary_page_id'] = 0; }
    $widget_title = self::DEFAULT_TITLE;
    $widget_text = self::DEFAULT_TEXT;
    $primary_link_text = $instance['primary_link_text'];
    $primary_link_url = null;
    $primary_link_html = null;
    $secondary_link_text = $instance['secondary_link_text'];
    $secondary_link_url = null;
    $secondary_link_html = null;

    $primary_page = get_post($instance['primary_page_id']);
    $secondary_page = get_post($instance['secondary_page_id']);

    if ($primary_page != null && $primary_page->post_type == 'page') {
        $widget_title  = apply_filters('widget_title', $primary_page->post_title, $instance, $this->id_base);
        if (has_excerpt($primary_page->ID)) {
            $widget_text = get_the_excerpt($primary_page->ID);
        }
        else {
            $page = get_post($primary_page->ID, 'OBJECT', 'display');
            $widget_text = substr($page->post_content, 0, 500) . "...";
        }
        $primary_link_url = get_the_permalink($primary_page->ID);
        $primary_link_html = "<a href=\"$primary_link_url\">$primary_link_text</a>";
        if ($secondary_page != null && $secondary_page->post_type == 'page') {
            $secondary_link_url = get_the_permalink($secondary_page->ID);
            $secondary_link_html = "<a href=\"$secondary_link_url\">$secondary_link_text</a>";
        }
    }

    //Print the HTML Output
    echo $args['before_widget'];

    echo $args['before_title'];
    echo $widget_title;
    echo $args['after_title'];

    $widget_text_html = '<p>%s</p>';
    $widget_text_html_formatted = sprintf($widget_text_html, $widget_text);

    $links_div = '<div class="widget-cics_usp_paginas-links"><p>%s<br />%s</p></div>';
    $links_div_formatted = sprintf($links_div, $primary_link_html, $secondary_link_html) ;

    $widget_html = $widget_text_html_formatted . $links_div_formatted;
    echo $widget_html;
    echo $args['after_widget'];
  }

  //Updates a particular instance of a widget
  public function update($new_instance, $old_instance) {
    $new_instance['primary_link_text']  = strip_tags($new_instance['primary_link_text']);
	$new_instance['secondary_link_text']  = strip_tags($new_instance['secondary_link_text']);
    $new_instance['primary_page_id'] = empty( $new_instance['primary_page_id'] ) ? 0 : intval( $new_instance['primary_page_id'] );
    $new_instance['secondary_page_id'] = empty( $new_instance['secondary_page_id'] ) ? 0 : intval( $new_instance['secondary_page_id'] );

    return $new_instance;
  }

  //Outputs the settings update form
  public function form($instance) {
	$primary_link_text = isset($instance['primary_link_text']) ? $instance['primary_link_text'] : self::DEFAULT_PRIMARY_LINK_TEXT;
	$primary_page_id = isset($instance['primary_page_id']) ? $instance['primary_page_id'] : 0;
	$primary_page_list_html = wp_dropdown_pages(array(
		'name' => esc_attr($this->get_field_name('primary_page_id')),
		'id' => esc_attr($this->get_field_id('primary_page_id')),
		'selected' => $primary_page_id,
		'echo' => false,
		'show_option_none' 	=> _x('Nenhuma (desativar)', 'cics_usp'),
		'option_none_value' => '-1',
	));

	$secondary_link_text = isset($instance['secondary_link_text']) ? $instance['secondary_link_text'] : self::DEFAULT_SECONDARY_LINK_TEXT;
	$secondary_page_id = isset($instance['secondary_page_id']) ? $instance['secondary_page_id'] : 0;
	$secondary_page_list_html = wp_dropdown_pages(array(
		'name' => esc_attr($this->get_field_name('secondary_page_id')),
		'id' => esc_attr($this->get_field_id('secondary_page_id')),
		'selected' => $secondary_page_id,
		'echo' => false,
		'show_option_none' 	=> _x('Nenhuma (desativar)', 'cics_usp'),
		'option_none_value' => '-1',
	));

    $form_html = '
		<p><strong>%s</strong></p>
		<p><label for="%s">%s</label><br />
		%s</p>
		<p><label for="%s">%s</label>
		<input id="%s" class="widefat" name="%s" type="text" value="%s"></p>
		<hr />
		<p><label for="%s">%s</label><br />
		%s</p>
		<p><label for="%s">%s</label>
		<input id="%s" class="widefat" name="%s" type="text" value="%s"></p>
	';

    $form_html_formatted = sprintf($form_html,
		_x('O título desse widget será definido com base no título da "Página do Link Primário"', 'cics_usp'),
		esc_attr($this->get_field_id('primary_page_id')),  _x('Página do Link Primário (que terá o seu resumo exibido)', 'cics_usp'),
		$primary_page_list_html,
		esc_attr($this->get_field_id('primary_link_text')), _x('Texto do Link Primário:', 'cics_usp'),
		esc_attr($this->get_field_id('primary_link_text')), esc_attr( $this->get_field_name('primary_link_text')), esc_attr($primary_link_text),

		esc_attr($this->get_field_id('secondary_page_id')),  _x('Página do link secundário:', 'cics_usp'),
		$secondary_page_list_html,
		esc_attr($this->get_field_id('secondary_link_text')), _x('Texto do Link Secundário:', 'cics_usp'),
		esc_attr($this->get_field_id('secondary_link_text')), esc_attr( $this->get_field_name('secondary_link_text')), esc_attr($secondary_link_text)
    );

    echo $form_html_formatted;
  }
}
