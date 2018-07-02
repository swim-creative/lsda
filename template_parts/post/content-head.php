<header class="entry-header">
	<?php

	global $post;
		if ( is_single() ) {

			//show category
			$category = get_the_category();
			if($category)
				echo '<a class="cat-link" href="' . get_category_link( $category[0]->term_id) . '">' . $category[0]->cat_name . '</a>';

			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {

			if ( '' != get_the_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>">
						<?php //the_post_thumbnail(); ?>
					</a>
				</div>
			<?php endif;
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

	if ( 'post' === get_post_type() ) : ?>
	<?php get_template_part( 'template_parts/post/content', 'meta' ); ?>
	<?php
	endif; ?>
</header>
