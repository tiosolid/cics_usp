<div class="row">
	<div class="col-md-12">
		<h2 class="page-header"><?php _e('Eventos e Workshops', 'cics_pesquisas'); ?></h2>
	</div>
</div>
<div class="row" id="archive-content">
	<div class="col-md-2 col-sm-12 col-xs-12">
		<div class="evento-filtro">
			<h3 class="item-subtitulo page-header"><?php _e('Tipo', 'cics_eventos'); ?></h3>
			<form action="<?= get_option('home') . '/eventos'; ?>" method="POST">
				<?php $filter_value =  isset($_POST['evento_tipo']) ? (int) $_POST['evento_tipo'] : 0; ?>
				<select name="evento_tipo" class="form-control" onchange="this.form.submit()">
					<option value="0" <?= ($filter_value == 0) ? ' selected="selected"' : ''; ?>>Todos</option>
					<option value="1" <?= ($filter_value == 1) ? ' selected="selected"' : ''; ?>>Eventos</option>
					<option value="2" <?= ($filter_value == 2) ? ' selected="selected"' : ''; ?>>Workshops</option>
				</select>
			</form>
		</div>
	</div>
	<div class="col-md-10">
		<p>Nenhum conteúdo para exibir</p>
	</div>
</div>
