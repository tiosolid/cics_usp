<div class="row">
	<div class="col-md-12">
		<h2 class="page-header"><?php _e('Pesquisas', 'cics_pesquisas'); ?></h2>
	</div>
</div>
<div class="row" id="archive-content">
	<div class="col-md-2">
		<div class="pesquisa-filtro">
			<h3 class="page-header"><?php _e('Status', 'cics_pesquisas'); ?></h3>
			<form action="<?= get_option('home') . '/pesquisas'; ?>" method="POST">
				<?php $filter_value =  isset($_POST['pesquisa_status']) ? (int) $_POST['pesquisa_status'] : 0; ?>
				<select name="pesquisa_status" class="form-control" onchange="this.form.submit()">
					<option value="0" <?= ($filter_value == 0) ? ' selected="selected"' : ''; ?>>Todos</option>
					<option value="1" <?= ($filter_value == 1) ? ' selected="selected"' : ''; ?>>Em Andamento</option>
					<option value="2" <?= ($filter_value == 2) ? ' selected="selected"' : ''; ?>>Finalizada</option>
				</select>
			</form>
		</div>
	</div>
	<div class="col-md-10">
		<p>Nenhum conteúdo para exibir</p>
	</div>
</div>
