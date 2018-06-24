<div class="row">
	<div class="col-md-12">
		<h2 class="page-header"><?php _e('Eventos e Workshops', 'cics_eventos'); ?></h2>
	</div>
</div>
<div class="row" id="archive-content">
	<div class="col-md-2 col-sm-12 col-xs-12">
		<div class="evento-filtro">
			<h3 class="item-subtitulo page-header"><?php _e('Tipo', 'cics_eventos'); ?></h3>
			<form action="<?= get_option('home') . '/eventos'; ?>" method="POST">
				<?php $filter_value =  isset($_POST['evento_tipo']) ? (int) $_POST['evento_tipo'] : 0; ?>
				<select name="evento_tipo" class="form-control" onchange="this.form.submit()">
					<option value="0" <?= ($filter_value == 0) ? ' selected="selected"' : ''; ?>>Todos</option>
					<option value="1" <?= ($filter_value == 1) ? ' selected="selected"' : ''; ?>>Eventos</option>
					<option value="2" <?= ($filter_value == 2) ? ' selected="selected"' : ''; ?>>Workshops</option>
				</select>
			</form>
		</div>
	</div>
	<div class="col-md-10 col-sm-12 col-xs-12">
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="evento-<?php the_ID(); ?>" class="row">
				<div class="col-md-12 item-titulo">
					<h3 class="page-header"><?php the_date('d/m/Y'); ?> - <?php the_title(); ?></h3>
				</div>
				<?php $content_classes = 'col-md-9 col-sm-12'; ?>
				<?php if (has_post_thumbnail()) : ?>
					<div class="col-md-4 col-sm-5">
						<img class="img-responsive" src="<?= cics_usp_get_post_thumbnail_url($post, 'noticia-thumbnail.jpg') ?>" />
					</div>
					<?php $content_classes = 'col-md-5 col-sm-7'; ?>
				<?php endif;?>
				<div class="<?= $content_classes; ?>">
					<p><?php the_excerpt(); ?></p>
					<p class="item-leiamais"><a href="<?php the_permalink(); ?>">Ler mais >></a></p>
				</div>
				<div class="col-md-3 col-sm-12">
					<h4 class="item-subtitulo sobre-evento"><?php _e('Sobre o Evento', 'cics_eventos'); ?></h4>
					<p><b>Local:</b><br /><?php the_field('evento_local'); ?></p>
					<p>
						<b>Data:</b><br />
						De <?php the_field('evento_data_inicio'); ?> à <?php the_field('evento_data_termino'); ?>,
						 das <?php the_field('evento_hora_inicio'); ?> às <?php the_field('evento_hora_termino'); ?>
					</p>
					<?php if (have_rows('evento_anexos')): ?>
						<p>
							<b>Anexos:</b><br />
							<?php while ( have_rows('evento_anexos') ) : the_row(); ?>
								<a class="download-link" href="<?php the_sub_field('arquivo'); ?>"><span class="glyphicon glyphicon-save"></span></a>
								<span class="download-titulo"><?php the_sub_field('titulo'); ?></span>
							<?php endwhile; ?>
						</p>
					<?php endif; ?>
					<?php if (get_field('evento_url')) : ?>
						<p class="item-leiamais">
							<a target="_blank" href="<?php the_field('evento_url'); ?>"><?php _e('Visite o site do evento', 'cics_eventos'); ?></a>
						</p>
					<?php endif; ?>
					<?php if (get_field('evento_url_inscricao')) : ?>
						<p class="item-leiamais">
							<a target="_blank" href="<?php the_field('evento_url_inscricao'); ?>"><?php _e('Faça sua inscrição online', 'cics_eventos'); ?></a>
						</p>
					<?php endif; ?>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
</div>
