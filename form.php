<?php

if(isset($_POST['submit']) && $_FILES['photo']['size'] > 0)
{
	include "db.php";
	$limitedext = array("jpg","png","jpeg");		// Permited file extension to upload
	
	//<a href=\"$_SERVER[PHP_SELF]\">back</a>		// Back URL
	
	$fileName 	= $_FILES['photo']['name']; 		// Name of uploaded file
	$tmpName  	= $_FILES['photo']['tmp_name']; 	// Temporary folder where the file was saved
	$fileSize 	= $_FILES['photo']['size']; 		// Size of uploaded file
	$fileType 	= $_FILES['photo']['type'];			// Type of uploaded file
	
	list($type, $extension) = split('[/.-]', $fileType); // Retrieving the extension from hte mime type
	
	if(!in_array($extension,$limitedext))			// Check for correct file extension
		die("Wrong file extension. "); 
    
	$name 		= $_POST['name'];
	$surname 	= $_POST['surname'];
	$address 	= $_POST['address'];
	$info 		= $_POST['info'];
	$type 		= $_POST['type'];
	$period 	= $_POST['period'];
	$company 	= $_POST['company'];
	
	$uploadDir 			= $_SERVER['DOCUMENT_ROOT']. "assets/images/trainees";				// Path to upload folder
	$uploadThumbDir 	= $_SERVER['DOCUMENT_ROOT']. "assets/images/trainees/thumbs";		// Path to upload thumbnail folder
	check_dir($uploadDir);							// Checking the upload dir. if:is_dir and if:is_writable
	check_dir($uploadThumbDir);							// Checking the upload dir. if:is_dir and if:is_writable
	
	/*if(!get_magic_quotes_gpc())
		$fileName = addslashes($fileName);*/		// I don't understand what is this for
	
	$query = "INSERT INTO aiesec_trainees ( name, surname, address, type, info, filetype, company, period) VALUES ('{$name}','{$surname}','{$address}','{$type}','{$info}','{$fileType}','{$company}','{$period}')";

	mysql_query($query) or die('Error, query failed '. mysql_error()); 

	$id = mysql_insert_id();			// Get id of the last INSERTed row
	
	$photo = "trainee_" .$id. '.' .$extension;		// Creating the new file name for the photo
	$newfile 	= $uploadDir . "/". $photo;			// Setting up the absolute path
		
	if (!move_uploaded_file($tmpName, $newfile)){
		print 'Error';
		exit();
	}	
	
	resize($fileType, $newfile, $uploadThumbDir );
		//$fp      	= fopen($tmpName, 'r');				// Opening temp file
		//$content 	= fread($fp, filesize($tmpName));		// Reading file to variable
		//$content 	= addslashes($content);
		//fclose($fp);									// Closing handler to temp file
		
	$query = "UPDATE aiesec_trainees SET id_photo='{$photo}' WHERE id='{$id}'";
	
	mysql_query($query) or die('Error, query failed '. mysql_error()); 
	
	mysql_close($connection);
	
	echo "<br>File $fileName uploaded<br>";
} 



function check_dir($dir){
	if (!is_dir("$dir")) { 			// Check if folder exists
        die ("The directory <b>($dir)</b> doesn't exist"); 
    } 
    if (!is_writeable("$dir")){ 	// Check if the folder is writable
		die ("The directory <b>($dir)</b> is NOT writable, Please CHMOD (777)"); 
    } 
	return;
}

function resize($fileType, $tmpName, $uploadThumbDir ){
	
	$ThumbWidth = 100; 				// The width of the thumbnail image
	
	//if($fileSize){

		if($fileType == "image/pjpeg" || $fileType == "image/jpeg"){
			$new_img = imagecreatefromjpeg($tmpName);
		}elseif($fileType == "image/x-png" || $fileType == "image/png"){
			$new_img = imagecreatefrompng($tmpName);
		}elseif($fileType == "image/gif"){
			$new_img = imagecreatefromgif($tmpName);
		}

		//list the width and height and keep the height ratio.
		list($width, $height) = getimagesize($tmpName);

		//calculate the image ratio
		$imgratio=$width/$height;

		if ($imgratio>1){
			$newwidth = $ThumbWidth;
			$newheight = $ThumbWidth/$imgratio;
		}else{
			$newheight = $ThumbWidth;
			$newwidth = $ThumbWidth*$imgratio;
		}

		//function for resize image.

		if (function_exists(imagecreatetruecolor)){
			$resized_img = imagecreatetruecolor($newwidth,$newheight);
		}else{
			die("Error: Please make sure you have GD library ver 2+");
		}

		//the resizing is going on here!
		imagecopyresized($resized_img, $new_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		//finally, save the image
		echo $uploadThumbDir."/trainee_1.jpg<br/>";
		if(!imagejpeg ($resized_img,$uploadThumbDir."/trainee_1.jpg",100)) echo'ERROR saving thumb';
		imagedestroy ($resized_img);
		imagedestroy ($new_img);
		echo 'Bravo';
	//}


}

?>