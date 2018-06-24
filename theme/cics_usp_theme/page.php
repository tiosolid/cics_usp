<?php get_header();?> <!-- incluindo o header no index -->
<section class="main-content">
	<?php if (function_exists('get_field') && function_exists('the_field')) : ?>
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<div class="row">
					<div class="col-md-12">
						<div itemscope itemtype="http://schema.org/NewsArticle" <?php post_class(); ?> id="post-<?php the_ID(); ?>">
							<p><h2 class="page-header" itemprop="headline">
								<?php the_title(); ?><br />
								<!--<small><?php echo get_the_date() . ' - ' . get_the_time(); ?></small>-->
							</h2></p>
							<div class="entry">
								<span itemprop="articleBody"><?php the_content(); ?></span>
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
