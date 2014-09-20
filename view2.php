<?php
	
	require_once('components/doorknob1.php');
	require_once('components/doorknob2.php');
	$image2 = new Doorknob2(155);
	$image3 = new Doorknob2(155);
	$image4 = new Doorknob2(155);
	$image5 = new Doorknob2(155);
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
	?>
	</div>
	<div class="test_field">
	<?php 
		$image3->paintRings(); 
	?>
	</div>
	<div class="test_field">
	<?php 
		$image4->paintRings(); 
	?>
	</div>
	<div class="test_field">
	<?php 
		$image5->paintRings(); 
	?>
	</div>

</body>
</html>