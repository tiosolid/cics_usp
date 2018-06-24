<?php
/*
Plugin Name: Pesquisas - CICS
Plugin URI:  https://bitbucket.org/EWTI_WEB/cics_wordpress_app/wiki/pt-br/plugin-pesquisas
Description: Plugin para criação e gerenciamento de pesquisas dentro do site do CICS - USP
Version:     1.0
Author:      Leandro Machado (TioSolid)
Author URI:  https://bitbucket.org/TioSolid/
*/
defined( 'ABSPATH' ) or die( 'No direct access' );

//Configura o tipo de post customizado: eventos
function setup_post_type_pesquisas() {
	$labels = array(
		'name' => 'Pesquisas',
		'singular_name' => 'Pesquisa',
		'add_new' => 'Adicionar Nova',
		'add_new_item' => 'Adicionar Nova Pesquisa',
		'edit_item' => 'Editar Pesquisa',
		'new_item' => 'Nova Pesquisa',
		'view_item' => 'Visualizar Pesquisa',
		'search_items' => 'Pesquisar por um Pesquisa',
		'not_found' => 'Nenhuma pesquisa encontrada',
		'not_found_in_trash' => 'Nenhuma pesquisa encontrada na lixeira',
		'all_items' => 'Todas as Pesquisas',
		'archives' => 'Arquivo de Pesquisas',
		'insert_into_item' => 'Inserir em uma Pesquisa',
		'uploaded_to_this_item' => 'Anexar um arquivo a este pesquisa',
		'featured_image' => 'Imagem de Destaque',
		'set_featured_image' => 'Configurar uma Imagem de Destaque',
		'remove_featured_image' => 'Remover a Imagem de Destaque',
		'use_featured_image' => 'Usar essa imagem como a imagem de destaque',
	);

	$args = array(
		'labels' => $labels,
		'description' => 'Pesquisas do CICS, na USP',
		'public' => true,
		'menu_icon' => 'dashicons-clipboard',
		'supports' => array('title', 'editor', 'author', 'custom-fields', 'excerpt'),
		'has_archive' => true,
		'rewrite' => array('slug' => 'pesquisas'),
	);
	register_post_type( 'cics_pesquisas', $args );
}
add_action( 'init', 'setup_post_type_pesquisas' );

function cics_pesquisas_widget_init() {
	require plugin_dir_path( __FILE__ ) . 'widgets/cics_pesquisas_widget.php';
	register_widget( 'Cics_Pesquisas_Widget' );
}
add_action( 'widgets_init', 'cics_pesquisas_widget_init' );

if( function_exists('acf_add_local_field_group') ) {
	acf_add_local_field_group(array (
		'key' => 'group_577a6d77c7d79',
		'title' => 'Informações da Pesquisa',
		'fields' => array (
			array (
				'key' => 'field_577a6d92938df',
				'label' => 'Status',
				'name' => 'pesquisa_status',
				'type' => 'select',
				'instructions' => 'Status atual da pesquisa',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					1 => 'Em Andamento',
					2 => 'Finalizada',
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
				'key' => 'field_577a8fb245665',
				'label' => 'Artigos',
				'name' => 'pesquisa_artigos',
				'type' => 'repeater',
				'instructions' => 'Artigos relacionados a essa pesquisa',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => 'field_577a900245666',
				'min' => '',
				'max' => '',
				'layout' => 'row',
				'button_label' => 'Adicionar Artigo',
				'sub_fields' => array (
					array (
						'key' => 'field_577a900245666',
						'label' => 'Título',
						'name' => 'titulo',
						'type' => 'text',
						'instructions' => 'Título do Artigo',
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
						'key' => 'field_577a904245667',
						'label' => 'Data',
						'name' => 'data',
						'type' => 'date_picker',
						'instructions' => 'Data de publicação do artigo',
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
						'key' => 'field_577a90e345668',
						'label' => 'Arquivo',
						'name' => 'arquivo',
						'type' => 'file',
						'instructions' => 'Arquivo do Artigo',
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
			array (
				'key' => 'field_577a924145669',
				'label' => 'Relatórios',
				'name' => 'pesquisa_relatorios',
				'type' => 'repeater',
				'instructions' => 'Relatórios relacionados a essa pesquisa',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => 'field_577a900245666',
				'min' => '',
				'max' => '',
				'layout' => 'row',
				'button_label' => 'Adicionar Relatório',
				'sub_fields' => array (
					array (
						'key' => 'field_577a92414566a',
						'label' => 'Título',
						'name' => 'titulo',
						'type' => 'text',
						'instructions' => 'Título do Relatório',
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
						'key' => 'field_577a92414566b',
						'label' => 'Data',
						'name' => 'data',
						'type' => 'date_picker',
						'instructions' => 'Data de publicação do relatório',
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
						'key' => 'field_577a92414566c',
						'label' => 'Arquivo',
						'name' => 'arquivo',
						'type' => 'file',
						'instructions' => 'Arquivo do Relatório',
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
			array (
				'key' => 'field_577a926a4566d',
				'label' => 'Projetos',
				'name' => 'pesquisa_projetos',
				'type' => 'repeater',
				'instructions' => 'Projetos relacionados a essa pesquisa',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => 'field_577a926a4566e',
				'min' => '',
				'max' => '',
				'layout' => 'row',
				'button_label' => 'Adicionar Projeto',
				'sub_fields' => array (
					array (
						'key' => 'field_577a926a4566e',
						'label' => 'Título',
						'name' => 'titulo',
						'type' => 'text',
						'instructions' => 'Título do Projeto',
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
						'key' => 'field_577a926a4566f',
						'label' => 'Data',
						'name' => 'data',
						'type' => 'date_picker',
						'instructions' => 'Data de publicação do projeto',
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
						'key' => 'field_577a926a45670',
						'label' => 'Arquivo',
						'name' => 'arquivo',
						'type' => 'file',
						'instructions' => 'Arquivo do Projeto',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'url',
						'library' => 'uploadedTo',
						'min_size' => '',
						'max_size' => '',
						'mime_types' => '',
					),
				),
			),
			array (
				'key' => 'field_577a92b545671',
				'label' => 'Pesquisadores',
				'name' => 'pesquisa_pesquisadores',
				'type' => 'relationship',
				'instructions' => 'Pesquisadores relacionadas a essa pesquisa',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array (
					0 => 'cics_pesquisadores',
				),
				'taxonomy' => array (
				),
				'filters' => array (
					0 => 'search',
				),
				'elements' => '',
				'min' => '',
				'max' => '',
				'return_format' => 'object',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'cics_pesquisas',
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

//Codigo a ser executado durante a ativação do plugin
function cics_pesquisas_activation() {
	//Adiciona opção ao primeiro menu encontrado no sistema
	$menus_array = wp_get_nav_menus();
	if (count($menus_array) > 0) {
		$menu = $menus_array[0];
		wp_update_nav_menu_item($menu->term_id, 0, array(
			'menu-item-title' =>  _x('Pesquisas', 'cics_eventos'),
	        'menu-item-url' => home_url( '/pesquisas/' ),
	        'menu-item-status' => 'publish'
		));
	}

	//Atualiza a estrutura de permalinks
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'cics_pesquisas_activation' );

//Codigo a ser executado durante a desativação do plugin
function cics_pesquisas_deactivation() {
	//Adiciona opção ao primeiro menu encontrado no sistema
	$menus_array = wp_get_nav_menus();
	if (count($menus_array) > 0) {
		$menu = $menus_array[0];
		$menu_objects = wp_get_nav_menu_items ($menu->term_id);
        if ( ! empty( $menu_objects ) ) {
            foreach ( $menu_objects as $item ) {
                if ($item->post_title == "Pesquisas") { wp_delete_post($item->ID, true); }
            }
        }
	}

	//Atualiza a estrutura de permalinks
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'cics_pesquisas_deactivation' );

function cics_pesquisas_contribuicoes($pesquisador_id) {
	$pesquisas_html = false;
	$pesquisas = get_posts(array(
		'post_type' => 'cics_pesquisas',
		'meta_query' => array(
			array(
				'key' => 'pesquisa_pesquisadores', // name of custom field
				'value' => '"' . $pesquisador_id . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
				'compare' => 'LIKE'
			)
		)
	));

	if (count($pesquisas) > 0) {
		$pesquisas_html = '<ul class="pesquisador-pesquisas">';
		foreach ($pesquisas as $pesquisa) {
			$pesquisa_url = get_post_permalink($pesquisa);
			$pesquisas_html .= "<li class=\"pesquisador-pesquisa\">
				<a href=\"$pesquisa_url\">$pesquisa->post_title</a>
			</li>
			";
		}
		$pesquisas_html .= '</ul>';
	}

	return $pesquisas_html;
}
?>
