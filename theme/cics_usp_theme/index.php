<?php get_header();?> <!-- incluindo o header no index -->
<section>
	<div class="row">
		<div class="col-md-12 slider-topo">
			<?php get_template_part('slider', 'topo'); ?>
		</div>
	</div><!-- fim da /.row -->
</section>
<section class="main-content">
	<div class="row">
		<?php get_sidebar(); ?>
	</div><!-- fim da /.row que vai o sobre cics / noticias / eventos / pesquisas cics / cics facts -->

	<div class="row">
		<div class="col-lg-12 widget">
			<?php get_template_part('slider', 'parceiros'); ?>
		</div><!-- fim do /.wrapper-parceiros -->
	</div><!-- fim da /.row do /.wrapper-parceiros -->
</section><!-- fim do /.main-content -->
<?php get_footer(); ?> <!-- incluindo o footer no index -->
