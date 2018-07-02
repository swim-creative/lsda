<section class="three-two" id="landing-head">
	<div class="container">
		<div class="row">
			<?php
			$columns = get_field('landing_page_header');

			foreach ($columns as $column) {

			//echo '<div class="column-row">';
				echo '<div class="left">'.$column['left_column'].'</div>';
				echo '<div class="right">'.$column['sidebar'].'</div>';
			//echo '</div>';
			}

			?>

		</div>
	</div>
</section>
