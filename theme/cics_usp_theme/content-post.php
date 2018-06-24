<div class="row">
	<div class="col-lg-12">
		<div itemscope itemtype="http://schema.org/NewsArticle" <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<p>
				<h2 class="page-header" itemprop="headline"><?php the_title(); ?></h2>
			</p>
		</div>
	</div>

	<div class="col-lg-10 col-md-10">
		<div itemscope itemtype="http://schema.org/NewsArticle" <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<div class="entry">
				<span itemprop="articleBody"><?php the_content(); ?></span>
			</div>
		</div>
	</div>
</div>
