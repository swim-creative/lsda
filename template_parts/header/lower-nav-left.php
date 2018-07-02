<button class="mini-toggle animated" aria-expanded="false" >
	<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'lsd' ); ?></span>
	<span></span><span></span><span></span>
</button>

<nav id="lower-nav-left" class="site-navigation" role="navigation">
		<ul class="main-menu menu">
		<?php
				wp_nav_menu( array(
						'menu'    => 'lower-left',
						'container_class'				=> 'main-menu',
						'depth'             => 2,
						'container'         => false,
						'items_wrap' 				=> '%3$s'
				) );

				//add search form search-toggle
			//	echo '<li id="site-search" class="search-toggle">' . get_search_form( false ) . '</li>';
		?>
	</ul>
</nav><!-- #site-navigation -->
