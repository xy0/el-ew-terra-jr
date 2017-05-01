<?php /* Template Name: Full Page */ ?>
<?php get_header() ?>
<?php ter_template_comment(__FILE__) ?>
<div id="main" class="container">
	<div id="main-row" class="row">
		<div id="primary" class="<?php echo TER_FULL_WIDTH_CLASS ?>">
			<div id="content" role="main">
				<?php
					function ew_enqueue_script() {
						wp_enqueue_script( '/wp-content/themes/terra-jr/js/jquery.counterup.js' );
					};
					the_post() ;
				?>
				<?php get_template_part('content','page') ?>
			</div><!-- /#content -->
		</div><!-- /#primary -->
	</div><!-- /#main-row -->
</div><!-- /#main -->
<?php get_footer() ?>