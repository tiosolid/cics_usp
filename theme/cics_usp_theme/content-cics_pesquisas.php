<div class="row">
	<div class="col-lg-12">
		<div itemscope itemtype="http://schema.org/NewsArticle" <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<p>
				<h2 class="page-header" itemprop="headline"><?php the_title(); ?></h2>
			</p>
		</div>
	</div>

	<div class="col-md-10">
		<div id="pesquisa-<?php the_ID(); ?>">
			<div class="pesquisa-assunto">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-5 col-sm-5 col-xs-12 pesquisa-anexos">
		<?php get_template_part('content', 'anexos_pesquisas'); ?>
	</div>
	<div class="col-md-5 col-sm-5 col-xs-12 pesquisa-pesquisadores">
		<?php get_template_part("pesquisadores"); ?>
	</div>
</div>
