<?php get_header();?> <!-- incluindo o header no index -->
<section class="main-content">
	<div class="row">
		<div class="col-md-12">
			<h2 class="page-header"><?php _e('404 - Página não Encontrada', 'cics_usp'); ?></h2>
			<p><?php _e('Desculpe, mas o conteúdo que você procurava não pôde ser encontrado.', 'cics_usp'); ?></p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p><?php _e('Utilize o campo abaixo para pesquisar pelo conteúdo que procurava ou navegue pelo menu no topo da página.', 'cics_usp'); ?></p>
			<form role="search" method="get" class="inline-group" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="form-group">
					<label sr-only="Buscar" for="input-search"></label>
					<input type="search" class="input-search" value="<?php echo get_search_query(); ?>" name="s">
					<button type="submit" class="btn btn-default input-search-btn">Buscar</button>
				</div>
			</form>
		</div>
	</div>
</section><!-- fim do /.main-content -->
<?php get_footer(); ?>
