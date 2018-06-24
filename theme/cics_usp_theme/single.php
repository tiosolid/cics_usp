<?php get_header();?> <!-- incluindo o header no index -->
<section class="main-content">
	<?php if (function_exists('get_field') && function_exists('the_field')) : ?>
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<?php get_template_part('content', get_post_type()); ?>
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
