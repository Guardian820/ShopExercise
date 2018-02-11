<?php 

	function validate_post(){
		if(isset($_POST['submit'])){
			include('connect.php');

			$name = $_POST['name'];
			$price = $_POST['price'];
			$type = $_POST['type'];
			$file_name = $_FILES['image']['name'];
			

			$upload_dir = "./images/post_images";
			$file_tmp = $_FILES["image"]["tmp_name"];
			
			$is_uploaded = move_uploaded_file($file_tmp, "$upload_dir/$file_name");
			$query = "INSERT INTO items(name,price,image,type)
			VALUES ('".$name."','".$price."','".$file_name."','".$type."')";

			$conn->query($query);	

			header('Location: index.php');				
		}
		
	}


	function echo_content($query){


		echo "	
			<div id='wrapper' class='container'>


				<div id='content'>
					<div class='row'>			
						";
					 
						include('php/connect.php');

						$result = $conn->query($query);
						while($row = $result->fetch_row()){
							$id = $row[0];
							$title = $row[1];
							$price = $row[2];
							$image = $row[3];
							echo "
								<div class='item col-md-3 col-xs-12'>
									<a href='post?id=$id'><img src='images/post_images/$image' class='item_image col-xs-10 col-xs-push-1'></a>
									<span class='item_name col-xs-10 col-xs-push-1'>$title</span>
									<br>
									<span class='item_price col-xs-10 col-xs-push-1'>$price</span>
								</div>
							";
						}

		echo "
					</div>
				</div>
				<div id='content_buttons' class='col-xs-10 col-xs-push-1'>
					<a id='prev' class='content_control'>Previous</a>
					<a id='next' class='content_control'>Next</a>
					
				</div>	
			</div>
		";

	}




	function echo_navbar(){
		echo "

			<div id='header' class='col-xs-12'>
				<!---->

				<div id='toggle_navbar' class='col-xs-12 hidden-md hidden-lg'>
					<img id='logo' src='images/planet.png'>
				</div>

				<div id='navbar' class='col-md-6 col-md-push-2'>
					<ul id='nav_ul'>
						<li class='col-md-2 col-xs-12'>
							<a href='index.php' value='home' class='menu_link'>Home</a>
						</li>
						<li class='col-md-2 col-xs-12'>
							<a href='men.php' value='men' class='menu_link'>Men</a>
						</li>
						<li class='col-md-2 col-xs-12'>
							<a href='women.php' value='women' class='menu_link'>Women</a>
						</li>
						<li class='col-md-2 col-xs-12'>
							<a href='art.php' value='art' class='menu_link'>Art</a>
						</li>
						<li class='col-md-2 col-xs-12'>
							<a href='books.php' value='book' class='menu_link'>Books</a>
						</li>
						<li class='col-md-2 col-xs-12'>
							<a href='create_post.php' value='create' class='menu_link'>Post</a>
						</li>
					</ul>

				</div>

				<div id='search' class='col-md-3 col-md-push-2 col-xs-12'>
					<form id='search_form'>
						<input type='text' name='name'  placeholder='Search' class='form_input'>
						<button type='submit' value='Submit' name='submit'>Submit</button>
					</form>
				</div>
			</div>
		";
	}












	function echo_header(){

		ini_set('display_errors', 1);
		
		

		echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">';
		
		echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';

		
		echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
		echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>';
		

		echo  '<link rel="stylesheet" type="text/css" href="css/style.css">';
		echo  '<script type="text/javascript" src="javascript/behaviour.js"> </script>';
		

		
	}







?>