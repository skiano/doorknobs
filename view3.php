<?php
	
	require_once('components/doorknob1.php');
	require_once('components/doorknob2.php');
	$image  = new Doorknob(50,50);
	$image4 = new Doorknob(50,50);
	$image2 = new Doorknob2(300);
	$image3 = new Doorknob2(300);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Too Many Door Knobs</title>

	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/doorknob.css">

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/toggle.js"></script>

</head>
<body>
	<!-- <h1>Too Many Door Knobs</h1> -->

	<div class="test_field">
	<?php 
		$image2->paintRings(); 
		$image2->fillCorners(); 
	?>
	</div>

	<div class="test_field">
	<?php 
		$image->paintGrid(12); 
	?>
	</div>

	<div class="test_field">
	<?php 
		$image4->paintGrid(12); 
	?>
	</div>

	<div class="test_field">
	<?php 
		$image3->paintRings(); 
		$image3->fillCorners(); 
	?>
	</div>



</body>
</html>