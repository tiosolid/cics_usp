<div class="row">
	<div class="col-md-12">
		<h2 class="page-header"><?php _e('Equipe', 'cics_usp'); ?></h2>
	</div>
</div>
<div class="row" id="archive-content">
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="pesquisador-<?php the_ID(); ?>">
		<div class="row">
			<div class="pesquisador-header col-md-12">
				<h3 class="item-subtitulo page-header">
					<?php the_title(); ?>
				</h3>
			</div>
		</div>
		<div class="row wrapper-equipe">
			<div class="pesquisador-imagem col-md-6 col-sm-6 col-xs-12">
				<img class="img-responsive pesquisador-foto" src="<?= cics_equipe_foto_url($post); ?>" />
			</div>
			<div class="pesquisador-informacoes col-md-6 col-sm-6 col-xs-12">
				<p><?= cics_equipe_tipo_html($post); ?></p>
				<div class="lele">
					<p>
						<span class="pesquisador-formacao"><?php the_field('pesquisador_formacao'); ?></span><br />
						<span class="pesquisador-titulo"><?php the_field('pesquisador_titulo'); ?></span>
					</p>
					<?= cics_equipe_lates_html($post); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="pesquisador-descricao col-md-12 col-sm-12">
				<?php the_content(); ?>
			</div>
		</div>
		<?php if (function_exists('cics_pesquisas_contribuicoes')) : ?>
			<?php $pesquisas_html = cics_pesquisas_contribuicoes(get_the_ID()); ?>
			<?php if ($pesquisas_html) : ?>
				<div class="row">
					<div class="col-md-12">
						<h4 class="pesquisador-contribuicoes"><?php _e('Contribuições:', 'cics_usp'); ?></h4>
						<?= $pesquisas_html; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>
