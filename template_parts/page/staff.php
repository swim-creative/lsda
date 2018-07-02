<section id="staff">
	<div class="container">
		<div class="row">
			<div class="dentists">
				<h3><?php the_field('dentist_headline'); ?></h3>
					<p><?php the_field('dentist_sub_headline'); ?></p>
				<div class="carousel staff">

					<?php get_template_part('template_parts/page/staff/dentists'); ?>

				</div>
			</div>

			<div class="ortho">
				<h3><?php the_field('ortho_headline'); ?></h3>
					<p><?php the_field('ortho_sub_headline'); ?></p>
					<?php

						get_template_part('template_parts/page/staff/orthodontists');

					?>
			</div>
		</div>
	</div>
</section>
