<?php
/**
 * Template Name: Page Columns Layout
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
		<main id="main" class="site-main entry-content" role="main">

			<?php

			while ( have_posts() ) : the_post();

			$columns = get_field('columns');

			foreach ($columns as $column) {
				echo '<div class="column-row">';
				echo '<div class="left">'.$column['column_1'].'</div>';
				echo '<div class="right">'.$column['column_2'].'</div>';
				echo '</div>';
			}

			endwhile; // End of the loop.
			?>

		</main>
	</div>
<?php
//get_sidebar();
get_footer();
