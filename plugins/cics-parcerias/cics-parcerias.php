<?php
/*
Plugin Name: Parcerias e Apoios - CICS
Plugin URI:  https://bitbucket.org/EWTI_WEB/cics_wordpress_app/wiki/pt-br/plugin-parcerias
Description: Plugin para gerenciamento das parcerias e apoios do CICS - USP
Version:     1.0
Author:      Leandro Machado (TioSolid)
Author URI:  https://bitbucket.org/TioSolid/
*/
defined( 'ABSPATH' ) or die( 'No direct access' );

define('PARCERIAS_APOIOS_PAGE_TITLE', 'Parcerias e Apoios');
define('SLIDER_PARCEIROS_PREFIX', 'Slider Parceiros');
define('SLIDER_APOIOS_NAME', 'Slider Apoios');

function cics_parcerias_init() {
	add_image_size('slide-parceiros', 9999, 180, false);
	add_image_size('slide-apoio', 168, 110, false);
}
add_action('init', 'cics_parcerias_init');


function cics_parcerias_activation()
{
	//O tema depende do plugin WEN Logo Slider
	if (!function_exists('run_WEN_Logo_Slider')) {
		$msg = _x('Esse plugin depende do plugin WEN Logo Slider para funcionar corretamente. Instale-o ou ative-o antes de continuar', 'cics_parcerias');
		die($msg);
	}

	$slider_meta = array(
		'wen_logo_slider_settings' => array(
			'images_per_slide' => '5',
			'enable_random_order' => '0',
			'slider_delay' => '4',
			'transition_time' => '1',
			'image_size' => 'slide-parceiros',
			'enable_navigation_arrow' => '1'
		)
	);

	//Cria o slider de parceiros ao ativar o plugin
	$slider = array(
		'post_title' => SLIDER_PARCEIROS_PREFIX,
		'post_type' => 'logo_slider',
		'post_status' => 'publish',
		'post_content' => '',
		'meta_input' => $slider_meta
	);
	wp_insert_post($slider);

	$slider_meta = array(
		'wen_logo_slider_settings' => array(
			'images_per_slide' => '5',
			'enable_random_order' => '0',
			'slider_delay' => '4',
			'transition_time' => '1',
			'image_size' => 'slide-apoio',
			'enable_navigation_arrow' => '1'
		)
	);

	//Cria o slider de apoios ao ativar o plugin
	$slider = array(
		'post_title' => SLIDER_APOIOS_NAME,
		'post_type' => 'logo_slider',
		'post_status' => 'publish',
		'post_content' => '',
		'meta_input' => $slider_meta
	);
	wp_insert_post($slider);

	//Criação da página "Parcerias e Apoios" e campos adicionais
	$pagina = array(
		'post_title' => PARCERIAS_APOIOS_PAGE_TITLE,
		'post_type' => 'page',
		'page_template' => 'template-parcerias.php',
		'post_status' => 'publish',
		'post_content' => _x('Entre em contato e seja você também um parceiro do CICS', 'cics_parcerias')
	);
	wp_insert_post($pagina);

	//Adiciona opção ao primeiro menu encontrado no sistema
	$menus_array = wp_get_nav_menus();
	if (count($menus_array) > 0) {
		$menu = $menus_array[0];
		$page = get_page_by_title(PARCERIAS_APOIOS_PAGE_TITLE);
		if ($page) {
			wp_update_nav_menu_item($menu->term_id, 0, array(
				'menu-item-title' => PARCERIAS_APOIOS_PAGE_TITLE,
		        'menu-item-url' => home_url( "/$page->post_name/" ),
		        'menu-item-status' => 'publish'
			));
		}
	}
}
register_activation_hook( __FILE__, 'cics_parcerias_activation' );

//Retorna todos os sliders (posts) de parceiros
function cics_parcerias_get_sliders($title) {
	$sliders = get_posts(array(
		'post_type' => 'logo_slider',
		's' => $title,
		'post_status' => 'publish'
	));

	return $sliders;
}

function cics_parcerias_get_slides($slider)
{
	if (!cics_parcerias_is_slider($slider)) { return false; }

	$slider_data = get_post_meta($slider->ID);
	if (isset($slider_data['_wls_slides'])) {
		$slides_array = unserialize($slider_data['_wls_slides'][0]);
		if (count($slides_array) > 0) {
			return $slides_array;
		}
	}

	return false;
}

function cics_parcerias_get_slider_settings($slider) {
	if (!cics_parcerias_is_slider($slider)) { return false; }

	$slider_data = get_post_meta($slider->ID);
	if (isset($slider_data['wen_logo_slider_settings'])) {
		$data_array = unserialize($slider_data['wen_logo_slider_settings'][0]);
		if (count($data_array) > 0) {
			return $data_array;
		}
	}

	return false;
}

function cics_parcerias_is_slider($slider) {
	if (is_object($slider) && (get_class($slider) == 'WP_Post')) {
		return true;
	}

	return false;
}

?>
