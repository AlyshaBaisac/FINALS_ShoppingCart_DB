<?php 
	define("DB_SERVER", "localhost");
	define("DB_USERNAME", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "shopping_db_cart");


	function openConnection(){
		$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
		if($con === false)
			die("Error: could not connect " . mysqli_connect_error());


		return $con;
	}

	function closeConnection($con){
		mysql_close($con);
	}

	function sanitizeinput($con, $input){
		return mysqli_real_escape_string($con, stripcslashes(htmlentities($input)));

	}	

	// function fileupload($imgInput){

	// 	$arr_Error = array()

	// 		$imageName = $imgInput['name'];
	// 		$imageSize = $imgInput['size'];
	// 		$imageTemp = $imgInput['tmp_name'];
	// 		$imageType = $imgInput['type'];

	// 		$imageExtTemp = explode ('.', $imageName);
	// 		$imgeExt = strtolower(end($imageExtTemp));


	// 		$arrInsertImage = array ('jpeg', 'jpg', 'png');
	// 		$ImageUpload = 'ImageUpload/';


	// 			if (in_array ($imageExtTemp, $arrInsertImage === false)) {
	// 				$arr_Error[] = "Extension File (" . $imageName .")  is not allowed only jpg, jpeg and png!";


	// 				if (empty($arr_Error)) {
	// 					move_uploaded_file($ImageTemp, $arrInsertImage, $imageName );

	// 				}else{
	// 					$arr_Error[] = 'fil upload error';

	// 				}return $arr_Error[] = $arr_Error;
	// 			}
	// }
 ?>