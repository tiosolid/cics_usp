<?php
/**
 * Template Name: Parcerias e Apoios
 *
 * @package Cics
 * @subpackage Usp
 * @since Eventos 1.0
 */
?>
<?php get_header(); ?>
<section class="main-content">
	<?php the_post(); //Prepara as funções de template do wordpress ?>
	<div class="row">
		<div class="col-md-12">
			<h2 class="page-header"><?php _e('Parcerias e Apoios', 'cics_parcerias'); ?></h2>
		</div>
	</div>
	<!-- Sliders de parceiros -->
	<?php $sliders = cics_parcerias_get_sliders(SLIDER_PARCEIROS_PREFIX); ?>
	<?php if (count($sliders) > 0) : ?>
		<div class="row">
			<div class="col-md-12">
				<h3 class="page-header item-subtitulo"><?php _e('Nossos Parceiros', 'cics_parcerias'); ?></h3>
			</div>
		</div>
		<?php foreach ($sliders as $slider) : ?>
			<div class="row">
				<?php $slides = cics_parcerias_get_slides($slider); ?>
				<?php $slider_settings = cics_parcerias_get_slider_settings($slider); ?>
				<?php if ($slides !== false) : ?>
					<?php $count = 0; ?>
					<?php foreach ($slides as $slide) : ?>
						<?php $count++; ?>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<?php $image_info = wp_get_attachment_image_src($slide['slide_image_id'], $slider_settings['image_size']); ?>
							<img class="img-responsive logo-parceiro center-block" src="<?= $image_info[0]; ?>" />
						</div>
						<?php if ( ($count % 3) == 0 ) : ?>
							<div class="clearfix"></div>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php else : ?>
					<div class="col-md-12">
						<p><?php _e('Nenhuma imagem para exibir', 'cics_parcerias'); ?></p>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	<!-- Sliders de parceiros -->

	<!-- Sliders de apoios -->
	<?php $sliders = cics_parcerias_get_sliders(SLIDER_APOIOS_NAME); ?>
	<?php if (count($sliders) > 0) : ?>
		<div class="row">
			<div class="col-md-12">
				<h3 class="page-header item-subtitulo"><?php _e('Apoio', 'cics_parcerias'); ?></h3>
			</div>
		</div>
		<?php foreach ($sliders as $slider) : ?>
			<div class="row">
				<?php $slides = cics_parcerias_get_slides($slider); ?>
				<?php $slider_settings = cics_parcerias_get_slider_settings($slider); ?>
				<?php if ($slides !== false) : ?>
					<?php $count = 0; ?>
					<?php foreach ($slides as $slide) : ?>
						<?php $count++; ?>
						<div class="col-md-2 col-sm-2 col-xs-12">
							<?php $image_info = wp_get_attachment_image_src($slide['slide_image_id'], $slider_settings['image_size']); ?>
							<img class="img-responsive logo-parceiro center-block" src="<?= $image_info[0]; ?>" />
						</div>
						<?php if ( ($count % 6) == 0 ) : ?>
							<div class="clearfix"></div>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php else : ?>
					<div class="col-md-12">
						<p><?php _e('Nenhuma imagem para exibir', 'cics_parcerias'); ?></p>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	<!-- Sliders de apoios -->

	<div class="row">
		<div class="col-md-12">
			<h3 class="page-header item-subtitulo"><?php _e('Participe do Cics', 'cics_parcerias'); ?></h3>
		</div>
		<div class="col-md-12">
			<div class="content">
				<?php the_content(); ?>
			</div>
		</div>
		<?php $page = get_page_by_title(FORM_CONTATO_PAGE_TITLE); ?>
		<?php if ($page) : ?>
			<div class="col-md-12">
				<hr>
				<div class="text-center">
					<a class="btn btn-primary btn-lg" href="<?= get_permalink($page); ?>">
						<?php _e('Entre em Contato', 'cics_parcerias'); ?>
					</a>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>
