<div class="row">
	<div class="col-md-12">
		<h2 class="page-header"><?php _e('Pesquisas', 'cics_pesquisas'); ?></h2>
	</div>
</div>
<div class="row" id="archive-content">
	<div class="col-md-2 col-sm-12 col-xs-12">
		<div class="pesquisa-filtro">
			<h3 class="item-subtitulo page-header"><?php _e('Status', 'cics_pesquisas'); ?></h3>
			<form action="<?= get_option('home') . '/pesquisas'; ?>" method="POST">
				<?php $filter_value =  isset($_POST['pesquisa_status']) ? (int) $_POST['pesquisa_status'] : 0; ?>
				<select name="pesquisa_status" class="form-control" onchange="this.form.submit()">
					<option value="0" <?= ($filter_value == 0) ? ' selected="selected"' : ''; ?>>Todos</option>
					<option value="1" <?= ($filter_value == 1) ? ' selected="selected"' : ''; ?>>Em Andamento</option>
					<option value="2" <?= ($filter_value == 2) ? ' selected="selected"' : ''; ?>>Finalizada</option>
				</select>
			</form>
		</div>
	</div>
	<div class="col-md-10 col-sm-12 col-xs-12">
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="pesquisa-<?php the_ID(); ?>" class="row">
				<div class="col-md-12 pesquisa-titulo">
					<h3 class="page-header"><?php the_title(); ?></h3>
				</div>
				<div class="col-md-5 pesquisa-assunto">
					<h4 class="pesquisa-subtitulo item-subtitulo"><?php _e('Assunto', 'cics_usp'); ?></h4>
					<div class="pesquisa-texto">
						<?php the_excerpt(); ?>
					</div>
					<div class="pesquisa-leiamais">
						<a href="<?php the_permalink(); ?>">Ler mais >></a>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 pesquisa-anexos">
					<?php get_template_part('content', 'anexos_pesquisas'); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 pesquisa-pesquisadores">
					<?php get_template_part("pesquisadores"); ?>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
</div>
