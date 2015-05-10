<section>
	<h2>Admin Control Panel</h2>
	<div class="div_admin">
		<?php
		//if its an admin session displayes the panel
		if($_SESSION['admin']==1){
			echo $data['tabla'];
		}
		?>
	</div>
</section>