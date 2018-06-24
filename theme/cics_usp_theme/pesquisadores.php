<h4 class="pesquisa-subtitulo item-subtitulo"><?php _e('Pesquisadores', 'cics_usp'); ?></h4>
<?php $pesquisadores = get_field('pesquisa_pesquisadores', get_the_ID()); ?>
<?php if ($pesquisadores) : ?>
	<?php
	$pesquisadores_coordenador = array();
	$pesquisadores_outros = array();
	foreach ($pesquisadores as $pesquisador) {
		if (get_field('pesquisador_tipo', $pesquisador->ID) == 2 ) {
			$pesquisadores_coordenador[] = $pesquisador;
		}
		else {
			$pesquisadores_outros[] = $pesquisador;
		}
	};
	?>
	<?php $pesquisadores_ordenado = array_merge($pesquisadores_coordenador, $pesquisadores_outros); ?>
	<?php foreach ($pesquisadores_ordenado as $pesquisador) : ?>
		<div class="pesquisa-pesquisador" id="pesquisador-<?= $pesquisador->ID; ?>">
			<span class="pesquisador-nome"><?= $pesquisador->post_title; ?></span><br />
			<span class="pesquisador-titulo"><?php the_field('pesquisador_titulo', $pesquisador->ID); ?></span>
		</div>
	<?php endforeach; ?>
<?php else: ?>
	<p><i><?= _x('Nenhum pesquisador associado a essa pesquisa', 'cics_usp'); ?></i></p>
<?php endif; ?>
