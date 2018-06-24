<?php
/*
Plugin Name: Equipe - CICS
Plugin URI:  https://bitbucket.org/EWTI_WEB/cics_wordpress_app/wiki/pt-br/plugin-equipe
Description: Plugin para gerenciamento dos pesquisadores da Equipe do CICS
Version:     1.5
Author:      Leandro Machado (TioSolid)
Author URI:  https://bitbucket.org/TioSolid/
*/
defined( 'ABSPATH' ) or die( 'No direct access' );
define('CICS_EQUIPE_VERSION', 'cics_equipe_version');

//Configura o tipo de post customizado: eventos
function setup_post_type_equipe() {
	$labels = array(
		'name' => 'Pesquisadores',
		'singular_name' => 'Pesquisador',
		'add_new' => 'Adicionar Novo',
		'add_new_item' => 'Adicionar Novo Pesquisador',
		'edit_item' => 'Editar Pesquisador',
		'new_item' => 'Novo Pesquisador',
		'view_item' => 'Visualizar Pesquisador',
		'search_items' => 'Pesquisar por um Pesquisador',
		'not_found' => 'Nenhum pesquisador encontrado',
		'not_found_in_trash' => 'Nenhum pesquisador encontrado na lixeira',
		'all_items' => 'Todos os Pesquisadores',
		'archives' => 'Arquivo de Pesquisadores',
		'insert_into_item' => 'Inserir em um Pesquisador da Equipe',
		'uploaded_to_this_item' => 'Anexar um arquivo a este pesquisador',
		'featured_image' => 'Imagem de Destaque',
		'set_featured_image' => 'Configurar uma Imagem de Destaque',
		'remove_featured_image' => 'Remover a Imagem de Destaque',
		'use_featured_image' => 'Usar essa imagem como a imagem de destaque',
	);

	$args = array(
		'labels' => $labels,
		'description' => 'Pesquisadores do CICS, da USP',
		'public' => true,
		'menu_icon' => 'dashicons-universal-access',
		'supports' => array('title', 'editor', 'custom-fields'),
		'has_archive' => true,
		'rewrite' => array('slug' => 'equipe'),
	);
	register_post_type( 'cics_pesquisadores', $args );

	// ~~ Data "Migration" ~~
	$version = get_option(CICS_EQUIPE_VERSION, 0);
	if ($version < 1.5) {
		$membros = get_posts(array(
			'posts_per_page' => -1,
			'post_type' => 'cics_pesquisadores'
		));

		foreach ($membros as $membro) {
			$coordenador_flag = get_field('pesquisador_coordenador', $membro->ID);
			if ($coordenador_flag == true) {
				update_field('pesquisador_tipo', 2, $membro->ID);
			}
			else {
				update_field('pesquisador_tipo', 1, $membro->ID);
			}
		}
		update_option(CICS_EQUIPE_VERSION, 1.5);
	}
}
add_action( 'init', 'setup_post_type_equipe' );

if( function_exists('acf_add_local_field_group') ) {
	acf_add_local_field_group(array (
		'key' => 'group_57766b50af8b1',
		'title' => 'Informações do Pesquisador',
		'fields' => array (
			array (
				'key' => 'field_57766f44393a7',
				'label' => 'Foto',
				'name' => 'pesquisador_foto',
				'type' => 'image',
				'instructions' => 'Foto do pesquisador. O tamanho mínimo é: 173px x 173px',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'uploadedTo',
				'min_width' => 173,
				'min_height' => 173,
				'min_size' => '',
				'max_width' => 519,
				'max_height' => 519,
				'max_size' => '',
				'mime_types' => '',
			),
			array (
				'key' => 'field_57766b67393a3',
				'label' => 'Formação',
				'name' => 'pesquisador_formacao',
				'type' => 'text',
				'instructions' => 'Nome do curso / instituição de ensino formadora do pesquisador',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'Ex: PCC - POLI | USP',
				'prepend' => '',
				'append' => '',
				'maxlength' => 50,
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_57766d82393a4',
				'label' => 'Título',
				'name' => 'pesquisador_titulo',
				'type' => 'text',
				'instructions' => 'Título do pesquisador',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'Ex: Lawyer Ph.D. Executive Director & Professor',
				'prepend' => '',
				'append' => '',
				'maxlength' => 50,
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_57766e2d393a5',
				'label' => 'Lates',
				'name' => 'pesquisador_lates',
				'type' => 'url',
				'instructions' => 'URL para o lates desse pesquisador',
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
			'key' => 'field_57d99006ccd66',
			'label' => 'Tipo de Membro',
			'name' => 'pesquisador_tipo',
			'type' => 'select',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				1 => 'Pesquisador',
				2 => 'Coordenador',
				3 => 'Administrativo',
			),
			'default_value' => array (
				0 => 1,
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'return_format' => 'value',
			'placeholder' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'cics_pesquisadores',
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
}

function cics_equipe_change_post_order($query) {
	if (is_post_type_archive('cics_pesquisadores') && !is_admin() && $query->is_main_query()) {
		//Caso isso seja alterado, ver a funçao cics_equipe_change_orderby abaixo
		$query->set('orderby', array('meta_value' => 'DESC', 'title' => 'ASC'));
		$query->set('meta_key', 'pesquisador_tipo');
		$query->set('nopaging', true);
	}
}
add_action( 'pre_get_posts', 'cics_equipe_change_post_order', 1);

function cics_equipe_change_orderby($query) {
	if (is_post_type_archive('cics_pesquisadores') && !is_admin() && is_main_query()) {
		$query = "FIELD(wp_postmeta.meta_value, 2, 1, 3), wp_posts.post_title ASC";
	}
	return $query;
}
add_filter( 'posts_orderby' , 'cics_equipe_change_orderby' );

//Codigo a ser executado durante a ativação do plugin
function cics_equipe_activation() {
	//Adiciona opção ao primeiro menu encontrado no sistema
	$menus_array = wp_get_nav_menus();
	if (count($menus_array) > 0) {
		$menu = $menus_array[0];
		wp_update_nav_menu_item($menu->term_id, 0, array(
			'menu-item-title' =>  _x('Equipe', 'cics_equipe'),
	        'menu-item-url' => home_url( '/equipe/' ),
	        'menu-item-status' => 'publish'
		));
	}

	//Atualiza a estrutura de permalinks
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'cics_equipe_activation' );

//Codigo a ser executado durante a desativação do plugin
function cics_equipe_deactivation() {
	//Adiciona opção ao primeiro menu encontrado no sistema
	$menus_array = wp_get_nav_menus();
	if (count($menus_array) > 0) {
		$menu = $menus_array[0];
		$menu_objects = wp_get_nav_menu_items ($menu->term_id);
        if ( ! empty( $menu_objects ) ) {
            foreach ( $menu_objects as $item ) {
                if ($item->post_title == "Equipe") { wp_delete_post($item->ID, true); }
            }
        }
	}

	//Atualiza a estrutura de permalinks
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'cics_equipe_deactivation' );
?>
