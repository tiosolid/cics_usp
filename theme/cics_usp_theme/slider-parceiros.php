<?php $slider_id = get_option(SLIDER_PARCEIROS_OPTION); ?>
<?php if (cics_usp_has_slides($slider_id)) : ?>
	<h2 class="page-header"><?php _e("Nossos Parceiros", 'cics_usp'); ?></h2>
	<div class="widget-body">
		<?php echo do_shortcode("[WLS id='$slider_id']"); ?>
	</div>
<?php endif; ?>
