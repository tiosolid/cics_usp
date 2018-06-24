<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php if(!is_single()){ bloginfo('name'); } else { wp_title(); }  ?></title>

	<link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" >

	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="container hfeed site">
		<header class="header" id="topo">
			<div class="row">
				<div class="logo-busca">
					<div class="col-lg-9 col-md-8 col-sm-6 col-xs-12">
						<a href="<?= get_option('home') ?>">
							<img class="logo img-responsive" src="<?php bloginfo('template_directory') ?>/img/logo.png" alt="" />
						</a>
					</div><!-- fim da col responsavel pelo logo -->

					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<form role="search" method="get" class="form-inline pull-right form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<div class="form-group">
								<label sr-only="Buscar" for="s"></label>
								<input type="search" class="input-search form-control" value="<?php echo get_search_query(); ?>" name="s">
								<button type="submit" class="btn btn-default input-search-btn">Buscar</button>
							</div>

						</form>
					</div>
				</div>
			</div><!-- fim da /.row -->
		</header><!-- fim do header /#topo -->
	</div>
	<?php if (has_nav_menu('menu-topo-footer')) : ?>
		<div class="menu-principal">
			<div class="container">
				<div class="row" id="navigation">
					<div class="col-md-12">
						<nav class="navbar navbar-default" role="navigation"> <!--menu-->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="sr-only">Menu</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand visible-xs visible-sm" href="#">Menu</a>
							</div>
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<?php wp_nav_menu(array('theme_location' => 'menu-topo-footer','menu_class' => 'nav navbar-nav text-center'));?>
							</div>
						</nav><!--menu-->
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div class="container">
