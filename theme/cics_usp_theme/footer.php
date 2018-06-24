		</div><!-- .site / container -->
<footer>
		<div class="container">

				<div class="row">
					<div class="col-lg-3 col-md-2 col-sm-3 menu-footer">
						<?php if (has_nav_menu('menu-topo-footer')) : ?>
							<?php wp_nav_menu(array('theme_location' => 'menu-topo-footer','menu_class' => 'nav'));?>
						<?php endif; ?>
					</div>

					<div class="col-xs-12 visible-xs-block">
						<hr />
					</div>
					<address class="col-lg-3 col-md-3 col-sm-3 address-footer">
						<?= cics_usp_contact_info_html(); ?>
					</address>

					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 box_qr_code">
						<img class="qr_code img-responsive" src="<?php bloginfo('template_directory') ?>/img/qr_code_address.jpg" alt="" />
					</div>

					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 logo-footer text-right">
						<img class="img-responsive" src="<?php bloginfo('template_directory') ?>/img/logo-politecnica.png" alt="" />
					</div>
				</div>
				<?php wp_footer(); ?>

		</div>
</footer><!-- fim do /.footer -->
	</body>
</html>
