<section id="pseudo-crumb">
	<div class="container">
		<button class="mini-toggle animated" aria-expanded="false" >
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'lsd' ); ?></span>
			<span></span><span></span><span></span>
		</button>
		<ul class="sub-pages">
			<?php

			global $post;
			$page = get_page_by_path('comprehensive-care', OBJECT, 'page');
			$first = $page->ID;
			wp_list_pages( array(
	    'include' => $first,
			 'title_li' => ''
			) );

		 $args = array(
				//'sort_order' => 'menu_order',
				'sort_column' => 'menu_order',
				'child_of' => $first,
				'parent' => -1,
			);

			$pages = get_pages($args);

			foreach ($pages as $page) : ?>

			<li <?php if($post->ID == $page->ID) : echo 'class="current_page_item"'; endif; ?>><a href="<?php echo get_the_permalink($page); ?>"><?php echo $page->post_title; ?></a></li>

			<?php endforeach;

			?>
		</ul>
	</div>
</section>
