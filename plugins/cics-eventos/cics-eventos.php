<?php
/*
Plugin Name: Eventos e Workshops - CICS
Plugin URI:  https://bitbucket.org/EWTI_WEB/cics_wordpress_app/wiki/pt-br/plugin-eventos
Description: Plugin para criação e gerenciamento de eventos e workshops dentro do site do CICS - USP
Version:     1.2
Author:      Leandro Machado (TioSolid)
Author URI:  https://bitbucket.org/TioSolid/
*/
defined( 'ABSPATH' ) or die( 'No direct access' );

//Configura o tipo de post customizado: eventos
function setup_post_type_eventos() {
	$labels = array(
		'name' => 'Eventos e Workshops',
		'singular_name' => 'Evento / Workshop',
		'add_new' => 'Adicionar Novo',
		'add_new_item' => 'Adicionar Novo Evento / Workshop',
		'edit_item' => 'Editar Evento',
		'new_item' => 'Novo Evento',
		'view_item' => 'Visualizar Evento',
		'search_items' => 'Pesquisar por um Evento',
		'not_found' => 'Nenhum evento encontrado',
		'not_found_in_trash' => 'Nenhum evento encontrado na lixeira',
		'all_items' => 'Todos os Eventos',
		'archives' => 'Arquivo de Eventos',
		'insert_into_item' => 'Inserir no Evento',
		'uploaded_to_this_item' => 'Anexar um arquivo a este evento',
		'featured_image' => 'Imagem de Destaque',
		'set_featured_image' => 'Configurar uma Imagem de Destaque',
		'remove_featured_image' => 'Remover a Imagem de Destaque',
		'use_featured_image' => 'Usar essa imagem como a imagem de destaque',
	);

	$args = array(
		'labels' => $labels,
		'description' => 'Eventos e Workshops do CICS, na USP',
		'public' => true,
		'menu_icon' => 'dashicons-calendar-alt',
		'supports' => array('title', 'editor', 'comments', 'author', 'thumbnail', 'custom-fields', 'excerpt'),
		'has_archive' => true,
		'rewrite' => array('slug' => 'eventos'),
	);
	register_post_type( 'cics_eventos', $args );
}
add_action( 'init', 'setup_post_type_eventos' );

if( function_exists('acf_add_local_field_group') ) {
	acf_add_local_field_group(array (
		'key' => 'group_5772a61d53ab5',
		'title' => 'Cronograma do Evento',
		'fields' => array (
			array (
				'key' => 'field_5772a63e003af',
				'label' => 'Data de Início',
				'name' => 'evento_data_inicio',
				'type' => 'date_picker',
				'instructions' => 'Data de início do evento',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'd/m/Y',
				'return_format' => 'd/m/Y',
				'first_day' => 1,
			),
			array (
				'key' => 'field_5772a731003b0',
				'label' => 'Data de Término',
				'name' => 'evento_data_termino',
				'type' => 'date_picker',
				'instructions' => 'Data de término do evento',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'd/m/Y',
				'return_format' => 'd/m/Y',
				'first_day' => 1,
			),
			array (
				'key' => 'field_5772a779003b1',
				'label' => 'Hora de Início',
				'name' => 'evento_hora_inicio',
				'type' => 'time_picker',
				'instructions' => 'Hora de início do evento. Para eventos que duram mais de um dia, considere a hora de início de cada ciclo diário do evento',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'H:i',
				'return_format' => 'H:i',
			),
			array (
				'key' => 'field_5772a7df003b2',
				'label' => 'Hora de Término',
				'name' => 'evento_hora_termino',
				'type' => 'time_picker',
				'instructions' => 'Hora de término do evento. Para eventos que duram mais de um dia, considere a hora de término de cada ciclo diário do evento',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'H:i',
				'return_format' => 'H:i',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'cics_eventos',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	acf_add_local_field_group(array (
		'key' => 'group_5772857e44b0f',
		'title' => 'Informações do Evento',
		'fields' => array (
			array (
				'key' => 'field_577a685ceb03f',
				'label' => 'Tipo',
				'name' => 'evento_tipo',
				'type' => 'select',
				'instructions' => 'Tipo do evento a ser criado',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					1 => 'Evento',
					2 => 'Workshop',
				),
				'default_value' => array (
					0 => 1,
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array (
				'key' => 'field_577285ceb031c',
				'label' => 'Local',
				'name' => 'evento_local',
				'type' => 'text',
				'instructions' => 'Local do evento. Pode ser um endereço completo ou um ponto de referência',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'Ex: Rua xyz 123 / Prédio abc, sala 345',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_5772870db031d',
				'label' => 'Ponto de Referência',
				'name' => 'evento_lat_lon',
				'type' => 'google_map',
				'instructions' => 'Ponto de referência exato do evento. Deve ser definido para que as pessoas que desejem participar do evento possam traçar rotas até o mesmo. Pode ser diferente do campo "Local do Evento" (pode indicar por exemplo o estacionamento do evento ao invés do local exato)',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'center_lat' => '-23.5623343',
				'center_lng' => '-46.7333342',
				'zoom' => 16,
				'height' => '',
			),
			array (
				'key' => 'field_5772a5ad565ec',
				'label' => 'URL',
				'name' => 'evento_url',
				'type' => 'url',
				'instructions' => 'URL associada ao evento',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'http://www.exemplo.com',
			),
			array (
				'key' => 'field_5772c2b912ead',
				'label' => 'URL de Inscrição',
				'name' => 'evento_url_inscricao',
				'type' => 'url',
				'instructions' => 'URL para inscrição no evento',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'http://www.exemplo.com',
			),
			array (
				'key' => 'field_57732ba2956c5',
				'label' => 'Anexos',
				'name' => 'evento_anexos',
				'type' => 'repeater',
				'instructions' => 'Anexos (arquivos) relacionados a esse evento / workshop',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => 'field_577600246a956',
				'min' => '',
				'max' => '',
				'layout' => 'row',
				'button_label' => 'Adicionar Anexo',
				'sub_fields' => array (
					array (
						'key' => 'field_45666a5779002',
						'label' => 'Título',
						'name' => 'titulo',
						'type' => 'text',
						'instructions' => 'Título do Anexo',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => 50,
						'readonly' => 0,
						'disabled' => 0,
					),
					array (
						'key' => 'field_576a974560e38',
						'label' => 'Arquivo',
						'name' => 'arquivo',
						'type' => 'file',
						'instructions' => 'Arquivo do Anexo',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'url',
						'library' => '',
						'min_size' => '',
						'max_size' => '',
						'mime_types' => '',
					),
				),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'cics_eventos',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
}

function cics_eventos_widget_init() {
	require plugin_dir_path( __FILE__ ) . 'widgets/cics_eventos_widget.php';
	register_widget( 'Cics_Eventos_Widget' );
}
add_action( 'widgets_init', 'cics_eventos_widget_init' );

//Codigo a ser executado durante a ativação do plugin
function cics_eventos_activation() {
	//Adiciona opção ao primeiro menu encontrado no sistema
	$menus_array = wp_get_nav_menus();
	if (count($menus_array) > 0) {
		$menu = $menus_array[0];
		wp_update_nav_menu_item($menu->term_id, 0, array(
			'menu-item-title' =>  _x('Eventos e Workshops', 'cics_eventos'),
	        'menu-item-url' => home_url( '/eventos/' ),
	        'menu-item-status' => 'publish'
		));
	}

	//Atualiza a estrutura de permalinks
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'cics_eventos_activation' );

//Codigo a ser executado durante a desativação do plugin
function cics_eventos_deactivation() {
	//Adiciona opção ao primeiro menu encontrado no sistema
	$menus_array = wp_get_nav_menus();
	if (count($menus_array) > 0) {
		$menu = $menus_array[0];
		$menu_objects = wp_get_nav_menu_items ($menu->term_id);
        if ( ! empty( $menu_objects ) ) {
            foreach ( $menu_objects as $item ) {
                if ($item->post_title == "Eventos") { wp_delete_post($item->ID, true); }
            }
        }
	}

	//Atualiza a estrutura de permalinks
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'cics_eventos_deactivation' );
?>
