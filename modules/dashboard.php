<?php defined('BASEPATH') OR exit('no direct script access allowed');
$is_index = true;
include "template/header.php";
?>
<section class="section">
	<div class="container-fluid">
		<div class="row justify-content-center">
		<div class="col-md-8 col-12">
			<h2 class="mt-50">
				Welcome to <?php echo $webconfig['title']; ?>
			</h2>
			<p>
				<?php echo $webconfig['description']; ?>
			</p>
		</div>
	</div>
</section>
<?php
include "template/footer.php";
?>