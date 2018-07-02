<button class="menu-toggle animated" aria-expanded="false" >
	<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'lsd' ); ?></span>
	<span></span><span></span><span></span>
</button>

<nav id="primary-nav" class="site-navigation" role="navigation">
		<ul class="main-menu menu">
			<span>With locations in: </span>
		<?php
				wp_nav_menu( array(
						'menu'    => 'locations',
						'container_class'				=> 'main-menu',
					//	'depth'             => 2,
						'container'         => false,
						'items_wrap' 				=> '%3$s'
				) );

				//add search form search-toggle
				//echo '<li id="site-search" class="search-toggle">' . get_search_form( false ) . '</li>';
		?>
	</ul>
		
</nav><!-- #site-navigation -->

<nav id="mobile-nav" class="site-navigation" role="navigation">
		<ul class="main-menu menu">
			<span>With locations in: </span>
		<?php
				wp_nav_menu( array(
						'menu'    => 'mobile-navigation',
						'container_class'				=> 'main-menu',
					//	'depth'             => 2,
						'container'         => false,
						'items_wrap' 				=> '%3$s'
				) );

				//add search form search-toggle
				echo '<li id="site-search" class="search-toggle">' . get_search_form( false ) . '</li>';
		?>
	</ul>
</nav><!-- #site-navigation -->
