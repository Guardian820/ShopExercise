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

		include('php/connect.php');
		$id = $_GET['id'];
		$query = "SELECT * FROM items WHERE id='".$id."'";
		$result = $conn->query($query);
		if($result){
			$row = $result->fetch_row();
			$name = $row[1];
			$price = $row[2];
			$image = $row[3];
			echo "
				<div id='individual_post' class='col-md-10 col-md-push-1 col-xs-12'>			
					<div class='col-md-5 col-xs-12'>
						<img id='post_image' src='images/post_images/".$image."'>
					</div>
					<div id='post_info' class='col-md-3 col-xs-12'>
						<h3 id='post_name'>".$name."</h3><br>
						<span id='post_price'>".$price."</span><br>
						<button id='add_to_cart'>Add to Cart</button>
					</div>
				</div>
			";
		}else{
			echo $conn->error;
		}




	?>





</body>

</html>