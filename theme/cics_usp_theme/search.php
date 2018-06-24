<?php get_header(); ?>
<section class="main-content">
	<div class="row">
		<div class="col-md-12">
			<h2 class="page-header">
				<?php
				$total = count($posts);
				echo _x('Resultados da Busca por', 'cics_usp') . ' "' . get_search_query() . '" ' . "($total resultados)";
				?>
			</h2>
		</div>
	</div>
	<?php if (have_posts()) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="row">
				<div class="col-md-11 col-md-offset-1 resultado-busca" id="resultado-<?php the_ID(); ?>">
					<h3 class="page-header">
						<?php the_title(); ?>
						<span class="pull-right">(<?= cics_usp_post_type_name(get_post_type()); ?>)</span>
					</h3>
					<p><?php the_excerpt(); ?></p>
					<div class="pesquisa-leiamais">
						<a href="<?php the_permalink(); ?>">Ler mais >></a>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
		<div class="row" id="archive-navigation">
			<div class="col-md-12 text-center">
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
				<?php echo cics_usp_style_pagination($data); ?>
			</div>
		</div>
	<?php else : ?>
		<?php get_template_part('not-found'); ?>
	<?php endif; ?>
</section><!-- fim do /.main-content -->
<?php get_footer(); ?>
