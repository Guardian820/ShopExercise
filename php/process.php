<?php 



	include('connect.php');


	$action = $_POST['action'];

	if($action=='post'){
		$name = $_POST['name'];
		$price = $_POST['price'];
		$type = $_POST['type'];
		$file_name = $_FILES['file']['name'];
		

		$upload_dir = "../images/post_images";
		$file_tmp = $_FILES["file"]["tmp_name"];
		
		$is_uploaded = move_uploaded_file($file_tmp, "$upload_dir/$file_name");
		$query = "INSERT INTO items(name,price,image,type)
		VALUES ('".$name."','".$price."','".$file_name."','".$type."')";
		$conn->query($query);		
		echo $conn->error;
		echo $query;


	}else{
		$page = $_POST['page'];
		$per_page = 8;
		$query = '';

		if($action=='home'){
			$query = "SELECT * FROM items order by id desc limit ".(($page*$per_page)) .",".$per_page;
			$row_count = $conn->query("SELECT * FROM items")->num_rows;
		}else if($action=='men'){
			$query = "SELECT * FROM items WHERE type='men' order by id desc limit ".(($page*$per_page)) .",".$per_page;
			$row_count = $conn->query("SELECT * FROM items WHERE type='men'")->num_rows;
		}else if($action=='women'){
			$query = "SELECT * FROM items WHERE type='women' order by id desc limit ".(($page*$per_page)) .",".$per_page;
			$row_count = $conn->query("SELECT * FROM items WHERE type='women'")->num_rows;
		}else if($action=='art'){
			$query = "SELECT * FROM items WHERE type='art' order by id desc limit ".(($page*$per_page)) .",".$per_page;
			$row_count = $conn->query("SELECT * FROM items WHERE type='art'")->num_rows;
		}else if($action=='book'){
			$query = "SELECT * FROM items WHERE type='book' order by id desc limit ".(($page*$per_page)) .",".$per_page;
			$row_count = $conn->query("SELECT * FROM items WHERE type='book'")->num_rows;
		}else if($action=='search'){
			$search_input = $_POST['search_input'];
			$query = "SELECT * FROM items WHERE name LIKE '%".$search_input."%' order by id desc limit ".(($page*$per_page)) .",".$per_page;
			$row_count = $conn->query("SELECT * FROM items WHERE name LIKE '%".$search_input."%'")->num_rows;			
		}

		$result = $conn->query($query);
		$result_rows = $result->num_rows;
		$count = 0;

		echo '[';

			echo '{"total_posts":"'.$row_count.'"},';

			while($row = $result->fetch_row()){
				$name = $row[1];
				$price = $row[2];
				$image = $row[3];
				echo '{"name":"'.$row[1].'","price":"'.$row[2].'","image":"'.$row[3].'"}';
				$count += 1;
				if($count<$result_rows){
					echo ',';
				}
			}
		echo ']';
	}







?>