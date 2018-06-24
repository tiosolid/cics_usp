<?php $slider_id = get_option(SLIDER_TOPO_OPTION); ?>
<?php if (cics_usp_has_slides($slider_id)) : ?>
	<?php echo do_shortcode("[WLS id='$slider_id']"); ?>
<?php else : ?>
	<img class="img-responsive img-header" src="<?php bloginfo('template_directory') ?>/img/slide01.png" title="CICS">
<?php endif; ?>
