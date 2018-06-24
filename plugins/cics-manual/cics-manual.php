<?php
/*
Plugin Name: Manual - CICS
Plugin URI:  https://bitbucket.org/EWTI_WEB/cics_wordpress_app/wiki/pt-br/plugin-manual
Description: Plugin para exibição do manual do usuário na área de administração do site
Version:     1.0
Author:      Leandro Machado (TioSolid)
Author URI:  https://bitbucket.org/TioSolid/
*/
defined( 'ABSPATH' ) or die( 'No direct access' );

function cics_manual_menu() {
	$parent_menu_slug = 'cics_manual';
	$main_capability = 'publish_posts';

	$page_title = _x('Manual - CICS USP', 'cics_manual');
	$menu_title = _x('Manual', 'cics_manual');
	add_menu_page($page_title, $menu_title, $main_capability, $parent_menu_slug, function() { cics_manual_conteudo('conteudo.html'); }, 'dashicons-sos', 79);

	$submenu_slug = $parent_menu_slug . '_' . 'comum';
	$page_title = _x('Manual - Tarefas Comuns', 'cics_manual');
	$menu_title = _x('Tarefas Comuns', 'cics_manual');
	add_submenu_page($parent_menu_slug, $page_title, $menu_title, $main_capability, $submenu_slug, function() { cics_manual_conteudo('comum.html'); });

	$submenu_slug = $parent_menu_slug . '_' . 'noticias';
	$page_title = _x('Manual - Notícias (Posts) ', 'cics_manual');
	$menu_title = _x('Notícias (Posts)', 'cics_manual');
	add_submenu_page($parent_menu_slug, $page_title, $menu_title, $main_capability, $submenu_slug, function() { cics_manual_conteudo('noticias.html'); });

	$submenu_slug = $parent_menu_slug . '_' . 'paginas';
	$page_title = _x('Manual - Páginas', 'cics_manual');
	$menu_title = _x('Páginas', 'cics_manual');
	add_submenu_page($parent_menu_slug, $page_title, $menu_title, $main_capability, $submenu_slug, function() { cics_manual_conteudo('paginas.html'); });

	$submenu_slug = $parent_menu_slug . '_' . 'pesquisadores';
	$page_title = _x('Manual - Pesquisadores', 'cics_manual');
	$menu_title = _x('Pesquisadores', 'cics_manual');
	add_submenu_page($parent_menu_slug, $page_title, $menu_title, $main_capability, $submenu_slug, function() { cics_manual_conteudo('pesquisadores.html'); });

	$submenu_slug = $parent_menu_slug . '_' . 'eventos';
	$page_title = _x('Manual - Eventos', 'cics_manual');
	$menu_title = _x('Eventos', 'cics_manual');
	add_submenu_page($parent_menu_slug, $page_title, $menu_title, $main_capability, $submenu_slug, function() { cics_manual_conteudo('eventos.html'); });

	$submenu_slug = $parent_menu_slug . '_' . 'pesquisas';
	$page_title = _x('Manual - Pesquisas', 'cics_manual');
	$menu_title = _x('Pesquisas', 'cics_manual');
	add_submenu_page($parent_menu_slug, $page_title, $menu_title, $main_capability, $submenu_slug, function() { cics_manual_conteudo('pesquisas.html'); });

	$submenu_slug = $parent_menu_slug . '_' . 'sliders';
	$page_title = _x('Manual - Sliders', 'cics_manual');
	$menu_title = _x('Sliders', 'cics_manual');
	add_submenu_page($parent_menu_slug, $page_title, $menu_title, $main_capability, $submenu_slug, function() { cics_manual_conteudo('sliders.html'); });

	$submenu_slug = $parent_menu_slug . '_' . 'tema';
	$page_title = _x('Manual - Tema', 'cics_manual');
	$menu_title = _x('Tema', 'cics_manual');
	add_submenu_page($parent_menu_slug, $page_title, $menu_title, $main_capability, $submenu_slug, function() { cics_manual_conteudo('tema.html'); });
}
add_action( 'admin_menu', 'cics_manual_menu' );

function cics_manual_conteudo($file) {
	$html_path = plugin_dir_path( __FILE__ ) . "manual/$file";
	$img_url = plugin_dir_url( __FILE__ ) . 'manual';
	$css_path = plugin_dir_url( __FILE__ ) . 'manual/style.css';
	$html = file_get_contents($html_path);

	if ($html !== false) {
		$html = "<link rel=\"stylesheet\" href=\"$css_path\">" . $html;
		$html = str_replace('{{MANUAL_BASE_URL}}', get_admin_url(null, 'admin.php?page=cics_manual'), $html);
		$html = str_replace('{{MANUAL_IMAGE_BASE_URL}}', $img_url, $html);
		echo $html;
	}
}

?>
