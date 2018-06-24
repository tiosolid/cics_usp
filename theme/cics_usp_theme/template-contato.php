<?php
/**
* Template Name: Formulário de Contato
*
* @package Cics
* @subpackage Usp
* @since Eventos 1.0
*/
?>
<?php get_header();?> <!-- incluindo o header no index -->
<section class="main-content">
	<?php if (function_exists('get_field') && function_exists('the_field')) : ?>
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-header"><?php the_title(); ?></h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div <?php post_class(); ?> id="pagina-<?php the_ID(); ?>">
							<h3 class="page-header"><?php _e('Formulário de Contato', 'cics_usp'); ?></h3>
							<div class="entry">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
					<div class="col-md-7 col-md-offset-1">
						<div class="row">
							<div class="col-md-12">
								<h3 class="page-header"><?php _e('Dados de Contato', 'cics_usp'); ?></h3>
								<?= cics_usp_contact_info_html(); ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h3 class="page-header"><?php _e('Como Chegar', 'cics_usp'); ?></h3>
								<?php get_template_part('googlemaps', 'contato'); ?>
							</div>
						</div>

					</div>
				</div>
			<?php endwhile; ?>
		<?php else : ?>
			<?php get_template_part('not-found'); ?>
		<?php endif; ?>
	<?php else : ?>
		<div class="row">
			<p><strong>Você deve instalar e ativar o plugin "Advanced Custom Fields Pro" para que o tema possa funcionar corretamente!</strong></p>
		</div>
	<?php endif; ?>
</section><!-- fim do /.main-content -->
<?php get_footer(); ?> <!-- incluindo o footer no index -->
