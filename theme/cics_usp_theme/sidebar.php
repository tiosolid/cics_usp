<?php
/**
 * Template para exibição das três "sidebars" do tema
 */
?>
<div id="sidebar-esquerda" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	<div class="row">
		<?php dynamic_sidebar('sidebar-esquerda'); ?>
	</div>
</div>
<div id="sidebar-central" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	<div class="row">
		<?php dynamic_sidebar('sidebar-central'); ?>
	</div>
</div>
<div id="sidebar-direita" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	<div class="row">
		<?php dynamic_sidebar('sidebar-direita'); ?>
	</div>
</div>
