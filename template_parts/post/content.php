<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lsd
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php //get_template_part('template_parts/post/content-head'); ?>

	<div class="entry-content">
		<?php

		//beer check
		if ( 'beer' === get_post_type() ) :
			$e .= '<span class="abv">ABV: ' . get_field('abv') . '%</span> &nbsp; | &nbsp; ';
			$e .= '<span class="ibu">IBU: ' . get_field('ibu') . '</span> &nbsp; | &nbsp; ';
			$e .= '<span class="srm">SRM: ' . get_field('srm') . '</span>';
			$e .= '<hr>';

			echo $e;
		endif;
			if(is_home() || is_archive()) :
				get_template_part('template_parts/post/content-head');
					the_excerpt();
				else :
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'lsd' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lsd' ),
				'after'  => '</div>',
			) );
		endif;
		?>
	</div>
	<?php get_template_part( 'template_parts/post/content', 'footer' ); ?>
</article><!-- #post-## -->
