<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<?php if (have_rows('pesquisa_artigos')) : ?>
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="heading-artigos-<?php the_ID(); ?>">
				<h4 class="panel-title pesquisa-subtitulo item-subtitulo">
					<a role="button" data-toggle="collapse" data-parent="#accordion"
					href="#collapse-artigos-<?php the_ID(); ?>" aria-expanded="true" aria-controls="collapse-artigos-<?php the_ID(); ?>">
						<?php _e('Artigos', 'cics_usp'); ?>
					</a>
				</h4>
			</div>
			<div id="collapse-artigos-<?php the_ID(); ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-artigos-<?php the_ID(); ?>">
				<div class="panel-body">
					<ul>
						<?php while ( have_rows('pesquisa_artigos') ) : the_row(); ?>
							<li>
								<a class="download-link" href="<?php the_sub_field('arquivo'); ?>"><span class="glyphicon glyphicon-save"></span></a>
								<span class="download-data"><?php the_sub_field('data'); ?></span>
								<span class="download-titulo"><?php the_sub_field('titulo'); ?></span>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if (have_rows('pesquisa_relatorios')) : ?>
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="heading-relatorios-<?php the_ID(); ?>">
				<h4 class="panel-title pesquisa-subtitulo item-subtitulo">
					<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
					href="#collapse-relatorios-<?php the_ID(); ?>" aria-expanded="false" aria-controls="collapse-relatorios-<?php the_ID(); ?>">
						<?php _e('Relatórios', 'cics_usp'); ?>
					</a>
				</h4>
			</div>
			<div id="collapse-relatorios-<?php the_ID(); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-relatorios-<?php the_ID(); ?>">
				<div class="panel-body">
					<ul>
						<?php while ( have_rows('pesquisa_relatorios') ) : the_row(); ?>
							<li>
								<a class="download-link" href="<?php the_sub_field('arquivo'); ?>"><span class="glyphicon glyphicon-save"></span></a>
								<span class="download-data"><?php the_sub_field('data'); ?></span>
								<span class="download-titulo"><?php the_sub_field('titulo'); ?></span>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if (have_rows('pesquisa_projetos')) : ?>
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="heading-projetos-<?php the_ID(); ?>">
				<h4 class="panel-title pesquisa-subtitulo item-subtitulo">
					<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
					href="#collapse-projetos-<?php the_ID(); ?>" aria-expanded="false" aria-controls="collapse-projetos-<?php the_ID(); ?>">
						<?php _e('Projetos', 'cics_usp'); ?>
					</a>
				</h4>
			</div>
			<div id="collapse-projetos-<?php the_ID(); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-projetos-<?php the_ID(); ?>">
				<div class="panel-body">
					<ul>
						<?php while ( have_rows('pesquisa_projetos') ) : the_row(); ?>
							<li>
								<a class="download-link" href="<?php the_sub_field('arquivo'); ?>"><span class="glyphicon glyphicon-save"></span></a>
								<span class="download-data"><?php the_sub_field('data'); ?></span>
								<span class="download-titulo"><?php the_sub_field('titulo'); ?></span>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php if (!have_rows('pesquisa_artigos') && !have_rows('pesquisa_relatorios') && !have_rows('pesquisa_projetos')) : ?>
	<div class="hidden-xs">
		<p><i><?= _x('Nenhum documento anexado a essa pesquisa', 'cics_usp'); ?></i></p>
	</div>
<?php endif; ?>
