<section id="alert">
	<div class="container">
		<div class="numbers">
			<a href="tel:<?php
				$replace = array(' ', '(', ')', '-');
			  echo str_replace($replace,'', get_theme_mod('duluth_phone')); ?>">
				<span>Duluth <span>:</span>  </span><span class="genericon genericon-phone"></span><span><?php echo get_theme_mod('duluth_phone'); ?></span>
			</a>
			<a href="tel:<?php
				$replace = array(' ', '(', ')', '-');
				echo str_replace($replace,'', get_theme_mod('two_harbors_phone')); ?>">
				<span>Two Harbors <span>:</span> </span><span class="genericon genericon-phone"></span><span><?php echo get_theme_mod('two_harbors_phone'); ?></span>
			</a>
		</div>
		<?php get_template_part( 'template_parts/footer/site', 'social' ); ?>
	</div>
</section>
<a href="#" class="mobile-phone">
	<i style="display:inline-block;vertical-align:middle;" class="genericon genericon-phone"></i> Call Now
</a>
