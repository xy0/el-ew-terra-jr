<?php /* Template Name: Home */ ?>
<?php get_header() ?>
<?php ter_template_comment(__FILE__) ?>
<div class="ew-slider-bg" style="background-image:url('http://ew.fyn.host/wp-content/uploads/2017/05/tempbg.jpg');">
	<?php $recent = new WP_Query("post_id=52"); while($recent->have_posts()) : $recent->the_post();?>
	       <?php the_content(); ?>
	<?php endwhile; ?>
</div>
<div id="main" class="container">
	<div id="main-row" class="row">
		<div id="primary" class="<?php echo TER_FULL_WIDTH_CLASS ?>">
			<div id="content" role="main">
				<?php the_post() ?>
				<?php get_template_part('content','home') ?>
			</div><!-- /#content -->
		</div><!-- /#primary -->
	</div><!-- /#main-row -->
</div><!-- /#main -->
<?php get_footer() ?>