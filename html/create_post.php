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
	?>

	<div id='create_post' class='col-md-10 col-md-push-2 col-xs-12'>
		<h3>Create Post</h3>
		<form id='create_post_form' enctype='multipart/form-data' action='create_post.php' method='post'>
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

	<?php 
		validate_post();
	?>

</body>



</html>

