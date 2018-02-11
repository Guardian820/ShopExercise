<html>

<head>
	<?php 
		include('php/functions.php');
		echo_header();
	?>
	<title></title>
</head>

<body>

	<?php 
		echo_navbar();
		$query = "SELECT * FROM items WHERE type='art' order by id desc";
		echo_content($query);
	?>
	
</body>
</html>
