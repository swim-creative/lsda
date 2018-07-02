<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lsd
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template_parts/page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main>
	</div>
	<aside class="home-sidebar">
			<div class="carousel gallery">
				<?php
				$images = get_field('home_gallery');
				if( $images ): ?>
        <?php $i = 1; foreach( $images as $image ): ?>

				<a index="<?php echo $i; ?>" class="item" href="<?php echo $image['url']; ?>"><img src="<?php echo $image['sizes']['large']; ?>"/></a>

			<?php $i++; endforeach; ?>
				<?php endif; ?>
			</div>
			<a target="_blank" style="float:right" href="https://goo.gl/maps/XAfbWLpYkMy">Peek inside our clinic!</a>
	</aside>
<?php
//get_sidebar();
get_footer();
