<div class="row">
	<div class="col-lg-12">
		<div itemscope itemtype="http://schema.org/NewsArticle" <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<p>
				<h2 class="page-header" itemprop="headline"><?php the_title(); ?></h2>
			</p>
		</div>
	</div>

	<div class="col-md-10">
		<div itemscope itemtype="http://schema.org/NewsArticle" <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<div class="entry">
				<span itemprop="articleBody"><?php the_content(); ?></span>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h3 class="item-subtitulo"><?php _e('Sobre o Evento', 'cics_usp'); ?></h3>
		<p><b>Local:</b> <?php the_field('evento_local'); ?></p>
		<?php $ponto_referencia = get_field('evento_lat_lon'); ?>
		<p><b>Ponto de Referência:</b> <?= $ponto_referencia['address']; ?></p>
		<p>
			<b>Data:</b>
			De <?php the_field('evento_data_inicio'); ?> à <?php the_field('evento_data_termino'); ?>,
			 das <?php the_field('evento_hora_inicio'); ?> às <?php the_field('evento_hora_termino'); ?>
		</p>
		<?php if (get_field('evento_url')) : ?>
			<p class="item-leiamais">
				<b>Maiores Informações:</b>
				<a target="_blank" href="<?php the_field('evento_url'); ?>"><?php _e('Visite o site do evento', 'cics_eventos'); ?></a>
			</p>
		<?php endif; ?>
		<?php if (get_field('evento_url_inscricao')) : ?>
			<p class="item-leiamais">
				<b>Inscrições:</b>
				<a target="_blank" href="<?php the_field('evento_url_inscricao'); ?>"><?php _e('Faça sua inscrição online', 'cics_eventos'); ?></a>
			</p>
		<?php endif; ?>
		<?php if (have_rows('evento_anexos')): ?>
			<p>
				<b>Anexos:</b><br />
				<?php while ( have_rows('evento_anexos') ) : the_row(); ?>
					<a class="download-link" href="<?php the_sub_field('arquivo'); ?>"><span class="glyphicon glyphicon-save"></span></a>
					<span class="download-titulo"><?php the_sub_field('titulo'); ?></span>
				<?php endwhile; ?>
			</p>
		<?php endif; ?>
	</div>
</div>
<?php get_template_part('googlemaps', 'eventos'); ?>
