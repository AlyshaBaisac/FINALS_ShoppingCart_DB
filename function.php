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
		return mysqli_real_escape_string($con, stripcslashes(htmlspecialchars($input)));

	}	

	function fileUpload($imgInput){

		$arrErrors = array();
		
		  $imageName = $imgInput['name'];
          $imageSize = $imgInput['size'];
          $imageTemp= $imgInput['tmp_name'];
          $imageType= $imgInput['type'];

          $imageExtTemp = explode('.', $imageName);
          $imageExt = strtolower(end($imageExtTemp));

          $arrAllowedFiles = array('jpeg', 'jpg', 'png');
          $uploadDIR = 'ImageUpload/';

          if (in_array($imageExt, $arrAllowedFiles) === false) 
               $arrErrors[] = "extension file (".$imageName .")is not allowed, you can only choose JPG JPEG PNG";


            if (empty($arrErrors)) {
            	 move_uploaded_file($imageTemp, $uploadDIR . $imageName);
            }else{
               $arrErrors[] ='fil upload Error';
            }
           return $arrErrors[] = $arrErrors;
	}
 ?>