<?php ter_template_comment(__FILE__) ?>

<div id="owl">
	<div>
		<div class="col-sm-5">
			<h5>
				<ul>
					<li> yo </li>
				</ul>
			</h5>
		</div>
		<div class="col-sm-5">
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

	<div><img src="/wp-content/uploads/2012/11/slide2.jpg" /></div>
	<div><img src="/wp-content/uploads/2012/11/slide3.jpg" /></div>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("#owl").owlCarousel({
		navigation : false,
		slideSpeed : 300,
		paginationSpeed : 400,
		singleItem:true,
		autoPlay:true     
		// "singleItem:true" is a shortcut for:
		// items : 1,
		// itemsDesktop : false,
		// itemsDesktopSmall : false,
		// itemsTablet: false,
		// itemsMobile : false
	});
});
</script>
	
<div class="ew-squares">
	<div class="square">
	   <div class="content">
	        <div class="table">
	            <div class="table-cell">
	                <img class="rs" src="https://farm5.staticflickr.com/4144/5053682635_b348b24698.jpg"/>
	                <div class="text">
	                	Buisness
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="square">
	   <div class="content">
	        <div class="table">
	            <div class="table-cell">
	                <img class="rs" src="https://farm5.staticflickr.com/4144/5053682635_b348b24698.jpg"/>
	                <div class="text">
	                	Homes
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="square">
	   <div class="content">
	        <div class="table">
	            <div class="table-cell">
	                <img class="rs" src="https://farm5.staticflickr.com/4144/5053682635_b348b24698.jpg"/>
	                <div class="text">
	                	Service Providers
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="square">
	   <div class="content">
	        <div class="table">
	            <div class="table-cell">
	                <img class="rs" src="https://farm5.staticflickr.com/4144/5053682635_b348b24698.jpg"/>
	                <div class="text">
	                	Efficiency Resources
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>

<article id="post-0" class="page type-page hentry">
	<div class="entry-content">
		<?php the_content() ?>
	</div><!-- .entry-content --> 
</article><!-- #post-0 -->