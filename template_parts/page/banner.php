<section id="banner" <?php if(is_front_page()) : ?>class="hero"<?php endif; ?>>
	<div class="banner-bg" <?php global $post; if(get_the_post_thumbnail()) : echo 'style="background-image:url('.get_the_post_thumbnail_url($post->ID).')"';

	else :

		if(count(lsd_get_random_header_image()) != 0) :

		echo 'style="background-image:url('.lsd_get_random_header_image().')"';

	endif;

	endif; ?>>
	</div>
	<div class="container">
		<div class="banner-content">
			<?php if(is_front_page()) : ?>
				<?php echo get_field('hero_content'); ?>
			<?php else :
			if(is_home()) : ?>
				<h1>Blog</h1>
		<?php else : ?>
			<?php if(is_singular('post')) : ?>

				<?php get_template_part('template_parts/post/content-head'); ?>

			<?php else : ?>
				<?php if(get_field('headline')) :
					echo '<h1>'.get_field('headline');
					else :
					echo '<h1>'.get_the_title();
					endif;
					if(get_field('sub_headline')) :
						echo '<small>'.get_field('sub_headline').'</small></h1>';
					else:
					echo '</h1>';
		  endif; endif; endif; endif; ?>
		</div>
	</div>
	<?php do_action('add_to_banner'); ?>
</section>
