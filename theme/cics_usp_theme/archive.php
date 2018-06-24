<?php get_header(); ?>
<section class="main-content">
	<?php if (function_exists('get_field') && function_exists('the_field')) : ?>
		<?php if (have_posts()) : ?>
			<?php get_template_part( 'archives', get_post_type() ); ?>
			<?php
			// Previous/next page navigation.
			$data = get_the_posts_pagination(array(
				'type' => 'list',
				'show_all' => true,
				'prev_next' => true,
				'prev_text' => '<',
				'next_text' => '>',
				'screen_reader_text' => ' '
			));
			?>
			<div class="row" id="archive-navigation">
				<div class="col-md-12 text-center">
					<?php echo cics_usp_style_pagination($data); ?>
				</div>
			</div>
		<?php else : ?>
			<?php get_template_part(cics_usp_get_not_found_template()); ?>
		<?php endif; ?>
	<?php else : ?>
		<div class="row">
			<p><strong>Você deve instalar e ativar o plugin "Advanced Custom Fields Pro" para que o tema possa funcionar corretamente!</strong></p>
		</div>
	<?php endif; ?>
</section><!-- fim do /.main-content -->
<?php get_footer(); ?>
