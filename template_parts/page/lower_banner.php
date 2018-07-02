<?php

if(!empty(get_field('lower_banner')[0]['lower_banner_content'])) : ?>

<section id="lower-banner"
<?php

$one =  get_stylesheet_directory_uri().'/assets/img/lower-banner-bg.jpg';
$two = get_stylesheet_directory_uri().'/assets/img/lower-banner-bg-2.jpg';

$bgs = array($one, $two);

if(!is_front_page()) :
shuffle($bgs);
endif;

echo 'style="background-image:url('.array_shift($bgs).')"'; ?>

>
	<div class="container">

			<div class="lower-banner-content">

				<?php $row = get_field('lower_banner');
				foreach ($row as $r) {
					echo $r['lower_banner_content'];
				} ?>

		</div>
	</div>
</section>
<?php endif; ?>
