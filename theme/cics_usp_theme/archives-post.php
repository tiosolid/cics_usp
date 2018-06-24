<div class="row">
	<div class="col-md-12">
		<h2 class="page-header"><?php _e('Notícias', 'cics_eventos'); ?></h2>
	</div>
</div>
<div class="row" id="archive-content">
	<div class="col-md-12">
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="noticia-<?php the_ID(); ?>" class="row">
				<div class="col-md-12 item-titulo">
					<h3 class="page-header"><?php the_date('d/m/Y'); ?> - <?php the_title(); ?></h3>
				</div>
				<?php $content_classes = 'col-md-12 col-sm-12'; ?>
				<?php if (has_post_thumbnail()) : ?>
					<div class="col-md-4 col-sm-4">
						<img class="img-responsive" src="<?= cics_usp_get_post_thumbnail_url($post, 'noticia-thumbnail.jpg') ?>" />
					</div>
					<?php $content_classes = 'col-md-8 col-sm-8'; ?>
				<?php endif;?>
				<div class="<?= $content_classes; ?>">
					<p><?php the_excerpt(); ?></p>
					<p class="item-leiamais"><a href="<?php the_permalink(); ?>">Ler mais >></a></p>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
</div>
