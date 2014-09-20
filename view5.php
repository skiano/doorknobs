<?php
	
	require_once('components/doorknob1.php');
	require_once('components/doorknob2.php');
	$image  = new Doorknob(70,50);
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
		$image->paintGrid(12); 
	?>
	</div>

</body>
</html>