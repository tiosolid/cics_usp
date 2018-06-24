<?php
define('SOBRE_CICS_PAGE_TITLE', 'Sobre o CICS');
define('LIVING_LAB_PAGE_TITLE', 'CICS Living Lab');
define('FORM_CONTATO_PAGE_TITLE', 'Fale Conosco');
define('SLIDER_TOPO_OPTION', 'cics_usp_setting_slider_topo_id');
define('SLIDER_PARCEIROS_OPTION', 'cics_usp_setting_slider_parceiros_id');
define('SLIDER_SOBRE_CICS_OPTION', 'cics_usp_setting_slider_sobre_cics_id');
define('SLIDER_LIVING_LAB_OPTION', 'cics_usp_setting_slider_living_lab_id');
define('CONTACT_FORM_OPTION', 'cics_usp_setting_contact_form_id');
define('CONTACT_INFO_OPTION', 'cics_usp_setting_contact_info');

function cics_usp_check_acf($oldtheme_name, $oldtheme) {
	//O tema depende do plugin ACF
	if (!function_exists('acf_add_local_field_group') ||
		!function_exists('run_WEN_Logo_Slider') ||
		!function_exists('wpcf7')) {
		switch_theme($oldtheme->stylesheet);
		add_action( 'admin_notices', 'cics_usp_admin_notice' );
		return;
	}

	cics_usp_setup();
}
add_action("after_switch_theme", "cics_usp_check_acf", 1, 2);

function cics_usp_admin_notice() {
	$plugins_html = '
		<ul>
			<li><b>Advanced Custom Fields PRO</b></li>
			<li><b>WEN Logo Slider</b></li>
			<li><b>Contact Form 7</b></li>
		</ul>
	';
	$mensagem_pre = _x('Esse tema depende dos seguintes plugins, instale-os ou ative-os ANTES de ativar esse tema:', 'cics_usp');
	$mensagem_pos = _x('O tema anterior será ativado automaticamente', 'cics_usp');
	echo "<div class=\"error notice\"><p>$mensagem_pre</p>$plugins_html<p>$mensagem_pos</p></div>";
}

//Configurações genéricas
function cics_usp_init() {
	//Adiciona suporte a resumos (excerpts) para páginas - por default, somente posts suportam esse campo
	add_post_type_support( 'page', 'excerpt' );
	add_theme_support('post-thumbnails');

	//Tamanhos de imagem customizados para o template
	set_post_thumbnail_size(395, 300, false);
	add_image_size('slide-grande', 1280, 395, true);

	register_nav_menu( 'menu-topo-footer', 'Header / Footer' );
	//register_nav_menu( 'menu-footer', 'Menu Footer' );

	if( function_exists('acf_add_local_field_group') ) {
		acf_add_local_field_group(array (
			'key' => 'group_57800e883d5e2',
			'title' => 'Sobre o CICS',
			'fields' => array (
				array (
					'key' => 'field_57800ed34cee4',
					'label' => 'Missão',
					'name' => 'sobre_cics_missao',
					'type' => 'textarea',
					'instructions' => 'Texto do campo "missão". Parágrafos HTML e estilo são adicionados automaticamente',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => 'wpautop',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_57800f834cee6',
					'label' => 'Visão',
					'name' => 'sobre_cics_visao',
					'type' => 'textarea',
					'instructions' => 'Texto do campo "Visão". Parágrafos HTML e estilo são adicionados automaticamente',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => 'wpautop',
					'readonly' => 0,
					'disabled' => 0,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'page_template',
						'operator' => '==',
						'value' => 'template-about.php',
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
			'description' => 'Informações Adicionais da Página',
		));
	}

	if( function_exists('acf_add_local_field_group') ) {
		acf_add_local_field_group(array (
			'key' => 'group_5780128164cfc',
			'title' => 'CICS Living Lab',
			'fields' => array (
				array (
					'key' => 'field_578012b4ca733',
					'label' => 'A Concepção',
					'name' => 'cics_living_lab_concepcao',
					'type' => 'wysiwyg',
					'instructions' => 'Texto do campo "A Concepção". Parágrafos HTML e estilo são adicionados automaticamente',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'basic',
					'media_upload' => 0,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'page_template',
						'operator' => '==',
						'value' => 'template-labs.php',
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
			'description' => 'Informações Adicionais da Página',
		));
	}
}
add_action('init', 'cics_usp_init');

function cics_usp_setup() {
	//Troca o nome da categoria default para noticias
	wp_update_term(1, 'category', array(
	  'name' => 'Notícias',
	  'slug' => 'noticias'
	));

	//Criação da página "Sobre o CICS" e campos adicionais
	$pagina = array(
		'post_title' => SOBRE_CICS_PAGE_TITLE,
		'post_type' => 'page',
		'page_template' => 'template-about.php',
		'post_status' => 'publish',
		'post_content' => 'Sobre o CICS'
	);
	wp_insert_post($pagina);

	$pagina = array(
		'post_title' => LIVING_LAB_PAGE_TITLE,
		'post_type' => 'page',
		'page_template' => 'template-labs.php',
		'post_status' => 'publish',
		'post_content' => 'CICS Living Lab'
	);
	wp_insert_post($pagina);

	//Insere o slider padrão da index
	$slider_meta = array(
		'wen_logo_slider_settings' => array(
			'images_per_slide' => '1',
		    'enable_random_order' => '0',
		    'slider_delay' => '3',
		    'transition_time' => '1',
		    'image_size' => 'slide-grande',
		    'enable_navigation_arrow' => '1'
		)
	);
	$slider = array(
		'post_title' => 'Slider Topo (INDEX)',
		'post_type' => 'logo_slider',
		'post_status' => 'publish',
		'post_content' => '',
		'meta_input' => $slider_meta
	);
	$slider_id = wp_insert_post($slider);
	update_option(SLIDER_TOPO_OPTION, $slider_id);

	//Insere o slider da página Sobre o CICS
	$slider_meta = array(
		'wen_logo_slider_settings' => array(
			'images_per_slide' => '1',
		    'enable_random_order' => '0',
		    'slider_delay' => '3',
		    'transition_time' => '1',
		    'image_size' => 'slide-grande',
		    'enable_navigation_arrow' => '1'
		)
	);
	$slider = array(
		'post_title' => 'Slider - Sobre o CICS',
		'post_type' => 'logo_slider',
		'post_status' => 'publish',
		'post_content' => '',
		'meta_input' => $slider_meta
	);
	$slider_id = wp_insert_post($slider);
	update_option(SLIDER_SOBRE_CICS_OPTION, $slider_id);

	//Insere o slider da página CICS Living Lab
	$slider_meta = array(
		'wen_logo_slider_settings' => array(
			'images_per_slide' => '1',
		    'enable_random_order' => '0',
		    'slider_delay' => '3',
		    'transition_time' => '1',
		    'image_size' => 'slide-grande',
		    'enable_navigation_arrow' => '1'
		)
	);
	$slider = array(
		'post_title' => 'Slider - CICS Living Lab',
		'post_type' => 'logo_slider',
		'post_status' => 'publish',
		'post_content' => '',
		'meta_input' => $slider_meta
	);
	$slider_id = wp_insert_post($slider);
	update_option(SLIDER_LIVING_LAB_OPTION, $slider_id);

	//Insere o formulário de contato e a página para exibição do mesmo
	$form_html = '
		<div class="form-group">
		  <label for="nome">Seu nome (obrigatório)</label>
		  [text* nome id:nome class:form-control]
		</div>
		<div class="form-group">
		  <label for="email">Seu email (obrigatório)</label>
		  [email* email id:email class:form-control]
		</div>
		<div class="form-group">
		  <label for="empresa">Empresa</label>
		  [text empresa id:empresa class:form-control]
		</div>
		<div class="form-group">
		  <label for="cargo">Cargo</label>
		  [text cargo id:cargo class:form-control]
		</div>
		<div class="form-group">
		  <label for="assunto">Assunto (obrigatório)</label>
		  [select* id:assunto class:form-control assunto include_blank "Quero Participar do CICS como Empresa" "Quero Participar do CICS como Pesquisador" "Quero Visitar Sozinho" "Quero Visitar em Grupo" "Quero Desenvolver Pesquisa em Conjunto" "Quero Patrocinar"]
		</div>
		<div class="form-group">
		  <label for="mensagem">Sua Mensagem</label>
		  [textarea mensagem id:mensagem class:form-control]
		</div>

		[submit id:enviar class:btn class:btn-default "Enviar"]
	';

	$form_mail = array(
		'subject' => 'CICS - USP "[assunto]',
		'sender' => '[nome] <example@email.com>',
		'body' => "De: [nome] <[email]>\nAssunto: [assunto]\nEmpresa: [empresa]\nCargo: [cargo]\n\nCorpo da mensagem:\n[mensagem]\n\n--\nEste e-mail foi enviado de um formulário de contato em CICS - USP",
		'recipient' => 'example@email.com',
		'additional_headers' => 'Reply-To: [email]',
		'attachments' => '',
		'use_html' => false,
		'exclude_blank' => false
	);

	$form_messages = array(
		'mail_sent_ok' => 'Obrigado. Sua mensagem foi enviada com sucesso.',
		'mail_sent_ng' => 'Ocorreu um erro ao enviar sua mensagem. Tente novamente mais tarde.',
		'validation_error' => 'Um ou mais campos do formulário não foram preenchidos corretamente',
		'spam' => 'Ocorreu um erro ao enviar sua mensagem.',
		'accept_terms' => 'Você deve aceitar os termos de envio antes de continuar',
		'invalid_required' => 'Esse campo é obrigatório',
		'invalid_too_long' => 'O conteúdo desse campo é muito longo',
		'invalid_too_short' => 'O conteúdo desse campo é muito curto',
		'invalid_date' => 'O formato da data está incorreto',
		'date_too_early' => 'The date is before the earliest one allowed.',
		'date_too_late' => 'The date is after the latest one allowed.',
		'upload_failed' => 'There was an unknown error uploading the file.',
		'upload_file_type_invalid' => 'You are not allowed to upload files of this type.',
		'upload_file_too_large' => 'The file is too big.',
		'upload_failed_php_error' => 'There was an error uploading the file.',
		'invalid_number' => 'The number format is invalid.',
		'number_too_small' => 'The number is smaller than the minimum allowed.',
		'number_too_large' => 'The number is larger than the maximum allowed.',
		'quiz_answer_not_correct' => 'The answer to the quiz is incorrect.',
		'captcha_not_match' => 'O código digitado está incorreto.',
		'invalid_email' => 'Endereço de email inválido',
		'invalid_url' => 'URL inválida',
		'invalid_tel' => 'The telephone number is invalid.'
	);

	$form_meta = array(
		'_form' => $form_html,
		'_mail' => $form_mail,
		'_mail_2' => '',
		'_messages' => $form_messages,
		'_additional_settings' => '',
		'_locale' => 'pt_BR',
		'_config_errors' => ''
	);

	$form = array(
		'post_title' => 'Fale Conosco',
		'post_type' => 'wpcf7_contact_form',
		'post_status' => 'publish',
		'post_content' => $form_html,
		'meta_input' => $form_meta
	);
	$form_id = wp_insert_post($form);
	update_option(CONTACT_FORM_OPTION, $form_id);
	if ($form_id) {
		$pagina_form = array(
			'post_title' => FORM_CONTATO_PAGE_TITLE,
			'post_type' => 'page',
			'page_template' => 'template-contato.php',
			'post_status' => 'publish',
			'post_content' => "[contact-form-7 id=\"$form_id\" title=\"Fale Conosco\"]"
		);
		wp_insert_post($pagina_form);
	}
}

//Adiciona suporte a menus no tema
function cics_usp_register_nav_menu() {
	if ( function_exists('register_nav_menu') && function_exists('wp_create_nav_menu') ) {
		$top_menu_id = wp_create_nav_menu('Menu Principal');
		//$footer_menu_id = wp_create_nav_menu('Menu Secundário (Rodapé)');

		//Amarra os menus com suas posições
		$locations = get_theme_mod('nav_menu_locations');
		if (is_integer($top_menu_id)) { $locations['menu-topo-footer'] = $top_menu_id; }
		//if (is_integer($footer_menu_id)) { $locations['menu-footer'] = $footer_menu_id; }
		set_theme_mod('nav_menu_locations', $locations);
	}

	//Adiciona opção ao primeiro menu encontrado no sistema
	$menus_array = wp_get_nav_menus();
	if (count($menus_array) > 0) {
		$menu = $menus_array[0];
		//Menu Sobre o CICS
		$page = get_page_by_title(SOBRE_CICS_PAGE_TITLE);
		if ($page) {
			wp_update_nav_menu_item($menu->term_id, 0, array(
				'menu-item-title' => SOBRE_CICS_PAGE_TITLE,
		        'menu-item-url' => home_url( "/$page->post_name/" ),
		        'menu-item-status' => 'publish'
			));
		}

		//Menu CICS Living Lab
		$page = get_page_by_title(LIVING_LAB_PAGE_TITLE);
		if ($page) {
			wp_update_nav_menu_item($menu->term_id, 0, array(
				'menu-item-title' =>  LIVING_LAB_PAGE_TITLE,
		        'menu-item-url' => home_url( "/$page->post_name/" ),
		        'menu-item-status' => 'publish'
			));
		}

		//Menu Notícias
		wp_update_nav_menu_item($menu->term_id, 0, array(
			'menu-item-title' =>  _x('Notícias', 'cics_usp'),
	        'menu-item-url' => get_category_link(1),
	        'menu-item-status' => 'publish'
		));

		//Menu CICS Living Lab
		$page = get_page_by_title(FORM_CONTATO_PAGE_TITLE);
		if ($page) {
			wp_update_nav_menu_item($menu->term_id, 0, array(
				'menu-item-title' =>  FORM_CONTATO_PAGE_TITLE,
		        'menu-item-url' => home_url( "/$page->post_name/" ),
		        'menu-item-status' => 'publish'
			));
		}
	}

	//Atualiza a estrutura de permalinks
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'cics_usp_register_nav_menu', 20 );

//Configurações de meta_box para páginas
function cics_usp_default_metaboxes_page($hidden, $screen) {
	if ($screen->post_type == 'page') {
		$key = array_search('postexcerpt', $hidden);
		if ($key !== false) { unset($hidden[$key]); }

		$hidden[] = 'postimagediv';
		$hidden[] = 'pageparentdiv';
	}

	if ($screen->post_type == 'post') {
		$key = array_search('postexcerpt', $hidden);
		if ($key !== false) { unset($hidden[$key]); }
	}

	//Sempre esconder os seguintes campos
	$hidden[] = 'postcustom';
	$hidden[] = 'commentstatusdiv';
	$hidden[] = 'commentsdiv';
	$hidden[] = 'authordiv';
	$hidden[] = 'tagsdiv-post_tag';

	return $hidden;
}
add_filter('hidden_meta_boxes', 'cics_usp_default_metaboxes_page', 10, 2);

//Adiciona suporte a sidebars no tema
function cics_usp_register_sidebars() {
	if ( function_exists( 'register_sidebar' ) ) {
		register_sidebar(array(
			'id' => 'sidebar-esquerda',
			'name' => 'Coluna Esquerda',
			'description'   => __( 'Coluna Esquerda da Página Inicial', 'cics_usp' ),
			'before_widget' => '<div id="%1$s" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="page-header">',
			'after_title' => '</h2>',
		));

		register_sidebar(array(
			'id' => 'sidebar-central',
			'name' => 'Coluna Central',
			'description'   => __( 'Coluna Central da Página Inicial', 'cics_usp' ),
			'before_widget' => '<div id="%1$s" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="page-header">',
			'after_title' => '</h2>',
		));

		register_sidebar(array(
			'id' => 'sidebar-direita',
			'name' => 'Coluna Direita',
			'description'   => __( 'Coluna Direita da Página Inicial', 'cics_usp' ),
			'before_widget' => '<div id="%1$s" class="col-lg-12 col-md-12 col-sm-6 col-xs-12 widget no-border-title %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="page-header">',
			'after_title' => '</h2>',
		));
	}
}
add_action( 'widgets_init', 'cics_usp_register_sidebars' );

//Adiciona widgets ao tema
function cics_usp_widget_init() {
	require get_template_directory() . '/widgets/cics_usp_paginas_widget.php';
	register_widget( 'Cics_Usp_Paginas_Widget' );

	require get_template_directory() . '/widgets/cics_usp_noticias_widget.php';
	register_widget( 'Cics_Usp_Noticias_Widget' );

	require get_template_directory() . '/widgets/cics_usp_facts_widget.php';
	register_widget( 'Cics_Usp_Facts_Widget' );
}
add_action( 'widgets_init', 'cics_usp_widget_init' );


//Funções do tema
function cics_usp_style_pagination($html) {
	//Add bootstrap pagination component
	$html = str_replace("<ul class='page-numbers'>","<ul class='page-numbers pagination'>",$html);
	//Add bootstrap selected item pagination
	$html = str_replace("<li><span class='page-numbers current'>","<li class='active'><span class='page-numbers current'>",$html);
	return $html;
}

function cics_usp_get_post_thumbnail_url($post, $default_image = 'default-thumbnail.jpg') {
	$thumbnail_url = null;
	if (has_post_thumbnail($post)) {
	  $thumbnail_url = get_the_post_thumbnail_url($post);
	} else {
	  $thumbnail_url = get_bloginfo('template_url') . "/img/$default_image";
	}

	return $thumbnail_url;
}

//Funções de processamento de HTML para o plugin de Equipe
function cics_equipe_coordenador_html($post) {
	$html = null;
	$coordenador_flag = get_field('pesquisador_coordenador', $post->ID);
	if ($coordenador_flag == true) {
		$text = _x('Coordenador CICS', 'cics_usp');
		$html = "<span class=\"pesquisador-coordenador\">$text</span><br />";
	}

	return $html;
}

function cics_equipe_tipo_html($post) {
	$html = null;
	$id_tipo = get_field('pesquisador_tipo', $post->ID);

	switch ($id_tipo) {
		case 1: //Pesquisador
		break;

		case 2: //Coordenador
		$text = _x('Coordenador CICS', 'cics_usp');
		$html = "<span class=\"pesquisador-coordenador\">$text</span><br />";
		break;

		case 3: //Administrativo
		$text = _x('Administrador CICS', 'cics_usp');
		$html = "<span class=\"pesquisador-administrador\">$text</span><br />";
		break;

		default:
		break;
	}

	return $html;
}

function cics_equipe_lates_html($post) {
	$html = null;
	$lates_url = get_field('pesquisador_lates', $post->ID);
	if (strlen($lates_url) > 0) {
		$text = _x('Lattes', 'cics_usp');
		$html = "<a class=\"pesquisador-lates btn btn-default btn-sm btn-block\" href=\"$lates_url\" target=\"_blank\">$text</a>";
	}

	return $html;
}

function cics_equipe_foto_url($post) {
	$foto_url = get_field('pesquisador_foto', $post->ID);
	if (strlen($foto_url) == 0) {
	  $foto_url = get_bloginfo('template_url') . "/img/default-foto-membro.jpg";
	}

	return $foto_url;
}

//Altera os parâmetros de consulta para filtrar as Pesquisas
function cics_pesquisas_query($query) {
	if (is_post_type_archive('cics_pesquisas') && !is_admin() && $query->is_main_query()) {
		if (isset($_POST['pesquisa_status']) && ((int) $_POST['pesquisa_status'] != 0)) {
			$query->set('meta_key', 'pesquisa_status');
			$query->set('meta_value', (int) $_POST['pesquisa_status']);
		}
	}
}
add_action('pre_get_posts', 'cics_pesquisas_query', 1);

//Altera os parâmetros de consulta para filtrar os Eventos
function cics_eventos_query($query) {
	if (is_post_type_archive('cics_eventos') && !is_admin() && $query->is_main_query()) {
		if (isset($_POST['evento_tipo']) && ((int) $_POST['evento_tipo'] != 0)) {
			$query->set('meta_key', 'evento_tipo');
			$query->set('meta_value', (int) $_POST['evento_tipo']);
		}
	}
}
add_action('pre_get_posts', 'cics_eventos_query', 1);

//Funções de configuração
function cics_usp_settings() {
   // Add the section to reading settings so we can add our
   // fields to it
   add_settings_section(
	   'cics_usp_setting_section',
	   'Configurações do Tema - CICS USP',
	   'cics_usp_setting_section_callback',
	   'reading'
	);

   // Add the field with the names and function to use for our new
   // settings, put it in our new section
	add_settings_field(
		SLIDER_TOPO_OPTION,
		'Slider a ser exibido no topo da página inicial',
		'cics_usp_setting_slider_topo_callback',
		'reading',
		'cics_usp_setting_section'
	);
	register_setting( 'reading', SLIDER_TOPO_OPTION );

	add_settings_field(
		SLIDER_PARCEIROS_OPTION,
		'Slider a ser exibido na parte inferior da página inicial (parceiros)',
		'cics_usp_setting_slider_parceiros_callback',
		'reading',
		'cics_usp_setting_section'
	);
	register_setting( 'reading', SLIDER_PARCEIROS_OPTION );

	add_settings_field(
		SLIDER_SOBRE_CICS_OPTION,
		'Slider exibido na página "Sobre o CICS"',
		'cics_usp_setting_slider_sobre_cics_callback',
		'reading',
		'cics_usp_setting_section'
	);
	register_setting( 'reading', SLIDER_SOBRE_CICS_OPTION );

	add_settings_field(
		SLIDER_LIVING_LAB_OPTION,
		'Slider exibido na página "CICS Living Lab"',
		'cics_usp_setting_slider_living_lab_callback',
		'reading',
		'cics_usp_setting_section'
	);
	register_setting( 'reading', SLIDER_LIVING_LAB_OPTION );

	add_settings_field(
		CONTACT_INFO_OPTION,
		'Informações de Contato',
		'cics_usp_setting_contact_info_callback',
		'reading',
		'cics_usp_setting_section'
	);
	register_setting( 'reading', CONTACT_INFO_OPTION );
}
add_action( 'admin_init', 'cics_usp_settings' );

function cics_usp_setting_section_callback() {
	echo '<p>Configurações relacionadas ao tema atual</p>';
}

function cics_usp_setting_contact_info_callback() {
	$contact_info_text = get_option(CONTACT_INFO_OPTION, '');
	$contact_info_id = CONTACT_INFO_OPTION;
	$contact_info_description = _x('Não utilizar HTML. Parágrafos e quebras de linha serão convertidos automaticamente', 'cics_usp');
	$html = "
		<textarea name=\"$contact_info_id\" id=\"$contact_info_id\" rows=\"10\" cols=\"50\">$contact_info_text</textarea>
		<p class=\"description\">
			$contact_info_description
		</p>
	";

	echo $html;
}

function sliders_selectbox($select_id, $selected_value) {
	$args = array(
		'numberposts' => -1,
		'post_type' => 'logo_slider',
		'post_status' => 'publish'
	);
	$posts = get_posts($args);

	$html = "<select name=\"$select_id\" id=\"$select_id\">";
	$selected = ($selected_value == 0) ? 'selected=selected' : '';
	$html .= "<option $selected value=\"0\">Nenhum (Desativar)</option>";
	if ($posts) {
		foreach ($posts as $post) {
			$selected = ($selected_value == $post->ID) ? 'selected=selected' : '';
			$html .= "<option $selected value=\"$post->ID\">$post->post_title</option>";
		}
	}
	$html .= "</select>";
	return $html;
}

function cics_usp_setting_slider_topo_callback() {
	echo sliders_selectbox(SLIDER_TOPO_OPTION, get_option( SLIDER_TOPO_OPTION, 0 ));
}

function cics_usp_setting_slider_parceiros_callback() {
   echo sliders_selectbox(SLIDER_PARCEIROS_OPTION, get_option( SLIDER_PARCEIROS_OPTION, 0 ));
}

function cics_usp_setting_slider_sobre_cics_callback() {
	echo sliders_selectbox(SLIDER_SOBRE_CICS_OPTION, get_option( SLIDER_SOBRE_CICS_OPTION, 0 ));
}

function cics_usp_setting_slider_living_lab_callback() {
	echo sliders_selectbox(SLIDER_LIVING_LAB_OPTION, get_option( SLIDER_LIVING_LAB_OPTION, 0 ));
}

//Checa se um slider do site contém pelo menos uma imagem, retorna true / false
function cics_usp_has_slides($slider_id) {
	if (!function_exists('run_WEN_Logo_Slider')) { return false; } //Se o plugin não existir, retornar false
	if (get_post_status($slider_id) === false) { return false; } //Se o slider não existir, retornar false

	$slider_data = get_post_meta($slider_id);
	//var_dump($slider_data);

	if (isset($slider_data['_wls_slides'])) {
		$slides_array = unserialize($slider_data['_wls_slides'][0]);
		if (count($slides_array) > 0) { return true; }
	}

	return false;
}

function cics_usp_post_type_name($post_type) {
	$post_type_name = _x('Outros', 'cics_usp');

	switch ($post_type) {
		case 'cics_pesquisas':
			$post_type_name = _x('Pesquisa', 'cics_usp');
			break;
		case 'cics_eventos':
			$post_type_name = _x('Evento', 'cics_usp');
			break;
		case 'cics_pesquisadores':
			$post_type_name = _x('Pesquisador', 'cics_usp');
			break;
		case 'post':
			$post_type_name = _x('Notícia', 'cics_usp');
			break;
		case 'page':
			$post_type_name = _x('Página', 'cics_usp');
			break;
		default:
			$post_type_name = _x('Outros', 'cics_usp');
			break;
	}

	return $post_type_name;
}

function cics_usp_contact_info_html() {
	$contact_info_html = '';
	$contact_info = strip_tags(get_option(CONTACT_INFO_OPTION, ''));
	$contact_info_lines = explode("\n", $contact_info);
	if ($contact_info_lines) {
		foreach ($contact_info_lines as $line) {
			$contact_info_html .= "<p>$line</p>";
		}
	}

	return $contact_info_html;
}

function cics_usp_get_not_found_template() {
	if (is_post_type_archive('cics_pesquisas')) { return 'not-found-cics_pesquisas'; }
	if (is_post_type_archive('cics_eventos')) { return 'not-found-cics_eventos'; }

	return 'not-found';
}

function my_acf_init() {

	acf_update_setting('google_api_key', '');
}

add_action('acf/init', 'my_acf_init');
?>
