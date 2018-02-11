<html>

<head>
	<?php 
		include('php/functions.php');
		echo_header();
		
	?>
	<title></title>
</head>

<body>

		<img id='main_image' class='img-responsive col-xs-12' src='images/main_image/cosmos_0.jpg'>
		<?php 
			echo_navbar();
			$query = "SELECT * FROM items order by id desc";
			echo_content($query);
		?>



		<div id='individual_post' class='col-md-10 col-md-push-1 col-xs-12' hidden>
			
			<div class='col-md-5 col-xs-12'>
				<img id='post_image' src='images/post_images/art.jpg'>
			</div>
			<div id='post_info' class='col-md-3 col-xs-12'>
				<h3 id='post_name'>Name</h3><br>
				<span id='post_price'>Price</span><br>
				<button id='add_to_cart'>Add to Cart</button>
			</div>
			<div class='col-md-1 col-xs-12'>
				<button id='go_back'>Go back</button>
			</div>

		</div>

		<div id='create_post' class='col-md-10 col-md-push-2 col-xs-12' hidden>
			<h3>Create Post</h3>
			<form id='create_post_form' enctype='multipart/form-data'>
				<input type='text' name='name'  placeholder='Name' class='form_input' pattern='(?=.*[A-Za-z]).{5,}' title='Only Letters Please minimum 5'><br>
				<input type='number' name='price' placeholder='Price' class='form_input' pattern='(?=.*[0-9]).{1,}' title='Only Numbers Please minimum 1'><br>
				
				<select name="type" class='form_input'>
					<option value="" selected hidden>Type</option>
					<option value="men">Men</option>
					<option value="women">Women</option>
					<option value="art">Art</option>
					<option value="book">Book</option>
				</select><br>
				<input type='file' id='form_image' name='image'><br>
				<button type='submit' value='Submit' id='form_submit' name='submit'>Submit</button>
			</form>
		</div>
	<!--</div>-->


</body>



</html>
