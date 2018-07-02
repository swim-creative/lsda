<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lsd
 */

?>
<?php if( ! is_page_template('page-builder.php') ) {
	echo '</div></div>';
} ?>
	</div>

	<?php do_action('after_content'); ?>

	<div id="lightbox">
		<a class="lightbox-close" href="#">Close</a>
		<div class="lightbox-inner">
		</div>

	</div>


	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
		<!-- <p class="top-link">
  		<a href="#">Back to top</a>
  	</p> -->
		<?php get_template_part( 'template_parts/footer/site', 'contact' ); ?>
		<?php get_template_part( 'template_parts/footer/site', 'social' ); ?>
		<?php get_template_part( 'template_parts/footer/site', 'morefoot' ); ?>
		<?php get_template_part( 'template_parts/footer/site', 'info' ); ?>
		<?php //get_template_part( 'template_parts/footer/site', 'credits' ); ?>
		</div>
	</footer>
</div>
<?php wp_footer(); ?>

</body>
</html>
