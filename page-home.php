<?php /* Template Name: Home */ ?>
<?php get_header() ?>
<?php ter_template_comment(__FILE__) ?>
<div style="background: blue;">
	<div id="owl" class="ew-slides">
		<div>
			<div class="col-sm-2 ew-slide-left">
				<h5> Efficiency Works(tm) </h5>
				<ul>
					<li> Estes Park Light and Power </li>
					<li> Fort Collins Utilities </li>
					<li> Longmont Power &amp; Communications </li>
					<li> Loveland Water and Power </li>
					<li> Platte River Power Authority </li>
				</ul>
			</div>
			<div class="col-sm-5 ew-slide-right">
				<h3>
					About Us
				</h3>
				<h1>
					Serving Northern Colorado
				</h1>
				<p>
					Providing energy efficiency offerings and rebates through Efficiency Works(tm).
				</p>
				<button type="button" class="btn ew-button ew-blue">Learn More</button>
			</div>
		</div>
		<div>
			<div class="col-sm-2 ew-slide-left">
				<h5> Efficiency Works(tm) </h5>
				<ul>
					<li> Estes Park Light and Power </li>
					<li> Fort Collins Utilities </li>
					<li> Longmont Power &amp; Communications </li>
					<li> Loveland Water and Power </li>
					<li> Platte River Power Authority </li>
				</ul>
			</div>
			<div class="col-sm-5 ew-slide-right">
				<h3>
					About Us
				</h3>
				<h1>
					Serving Northern Colorado
				</h1>
				<p>
					Providing energy efficiency offerings and rebates through Efficiency Works(tm).
				</p>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#owl").owlCarousel({
			navigation : false,
			slideSpeed : 1600,
			paginationSpeed : 400,
			singleItem:true,
			autoPlay:true,
			// "singleItem:true" is a shortcut for:
			//items : 1,
			// itemsDesktop : false,
			// itemsDesktopSmall : false,
			// itemsTablet: false,
			// itemsMobile : false
		});
	});
	</script>
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