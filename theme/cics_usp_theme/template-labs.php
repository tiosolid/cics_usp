<?php
/**
 * Template Name: CICS Living Labs
 *
 * @package Cics
 * @subpackage Eventos
 * @since Eventos 1.0
 */
?>
<?php get_header();?> <!-- incluindo o header no index -->
<section class="main-content">
	<div class="row">
		<div class="col-md-12 slider-topo">
			<?php get_template_part('slider', 'labs'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h2 class="page-header"><?php the_title(); ?></h2>
				<div class="entry">
					<?php the_content(); ?>
				</div>
			<?php endwhile; else: ?>
				<?php get_template_part('not-found'); ?>
			<?php endif; ?>
		</div><!-- fim do texto principal -->

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="row">
				<?php if (function_exists('get_field') && get_field('cics_living_lab_concepcao')) : ?>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page-concepcao">
						<h3 class="page-header"><?php _e('A Concepção', 'cics_usp'); ?></h3>
						<?php the_field('cics_living_lab_concepcao'); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div><!-- fim da /.row que vai o conteúdo -->
</section>
<?php get_footer(); ?> <!-- incluindo o footer -->
