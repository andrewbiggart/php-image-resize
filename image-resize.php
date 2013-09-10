<?php
	
	if(isset($_POST)){

		$quality   = 100; // Image quality	
		$largeimg  = 100; // Large image size
		$mediumimg = 40;  // Medium image size
		$smallimg  = 20;  // Small image size
		$largesrc  = '../_assets/images/avatars/large/';  // Large image location
		$mediumsrc = '../_assets/images/avatars/medium/'; // Medium image location
		$smallsrc  = '../_assets/images/avatars/small/';  // Small image location
	
		// Check a file is present and has been uploaded via HTTP POST
		if(!isset($_FILES['ImageFile']) || !is_uploaded_file($_FILES['ImageFile']['tmp_name'])){
			die('There has been a problem uploading your file!');
		}
		
		// Generate random number to be added to file name to prevent duplicates
		$rand 	= rand(0, 9999999999); 
	
		// Set image name, size, location and type
		$imgname = str_replace(' ','-',strtolower($_FILES['ImageFile']['name'])); 
		$imgsize = $_FILES['ImageFile']['size']; // Obtain original image size
		$imgtemp = $_FILES['ImageFile']['tmp_name']; // Tmp name of image file stored in PHP tmp folder
		$imgtype = $_FILES['ImageFile']['type']; //Obtain file type, returns "image/png", image/jpeg, text/plain etc.
	
		// Check the file type is supported using PHP switch
		switch(strtolower($imgtype)){
			case 'image/png':
				$img =  imagecreatefrompng($_FILES['ImageFile']['tmp_name']);
				break;
			case 'image/gif':
				$img =  imagecreatefromgif($_FILES['ImageFile']['tmp_name']);
				break;			
			case 'image/jpeg':
			case 'image/pjpeg':
				$img = imagecreatefromjpeg($_FILES['ImageFile']['tmp_name']);
				break;
			default:
				die('Only jpgs, gifs and pngs are permitted!');
		}
		
		// Get the width and height of the temporary image
		list($imgwidth,$imgheight)=getimagesize($imgtemp);
		
		// Get the file extension to add after the image name
		$imgext = substr($imgname, strrpos($imgname, '.'));
		$imgext = str_replace('.','',$imgext);
		
		// Remove the file extension from the image to get orginal name
		$imgname = preg_replace("/\\.[^.\\s]{3,4}$/", "", $imgname); 
		
		// Create ne wimage name including random number, orginal name and extension
		$newimgname = $rand.'-'.$imgname.'.'.$imgext;
		
		// Create image destinations
		$largedest 	= $largesrc.$newimgname;
		$mediumdest = $mediumsrc.$newimgname;
		$smalldest 	= $smallsrc.$newimgname;
		
		// Crop to large image size
		if(!cropImage($imgwidth,$imgheight,$largeimg,$largedest,$img,$quality,$imgtype)){
			die('There was an error cropping the large image');
		}
		
		// Crop to medium image size
		if(!cropImage($imgwidth,$imgheight,$mediumimg,$mediumdest,$img,$quality,$imgtype)){
			die('There was an error cropping the medium image');
		}
		
		// Crop to small image size
		if(!cropImage($imgwidth,$imgheight,$smallimg,$smalldest,$img,$quality,$imgtype)){
			die('There was an error cropping the small image');
		}
	
		// Save the new filename to the database (OPTIONAL)
		$userid = 1;
		$sql    = " UPDATE table_name SET image_location = '$newimgname' WHERE userid = '$userid' ";
		$result = mysql_query($sql);
					
		if($result){
			echo $largedest; // Return the new filename
		} else {
			echo 4;
		}
		
		// Return large image
		echo '<img src="'.$largedest.'" alt="Uploaded image" />';
	
	}
	
	//////////////////////////////////////////////////////////////
	// Function to crop images into a squares
	//////////////////////////////////////////////////////////////
	function cropImage($CurWidth,$CurHeight,$iSize,$DestFolder,$SrcImage,$Quality,$ImageType){	 

		if($CurWidth <= 0 || $CurHeight <= 0){
			return false;
		}

		if($CurWidth>$CurHeight){
			$y_offset = 0;
			$x_offset = ($CurWidth - $CurHeight) / 2;
			$square_size 	= $CurWidth - ($x_offset * 2);
		}else{
			$x_offset = 0;
			$y_offset = ($CurHeight - $CurWidth) / 2;
			$square_size = $CurHeight - ($y_offset * 2);
		}
		
		$NewCanves 	= imagecreatetruecolor($iSize, $iSize);	
		
		if(imagecopyresampled($NewCanves, $SrcImage,0, 0, $x_offset, $y_offset, $iSize, $iSize, $square_size, $square_size)){
			switch(strtolower($ImageType))
			{
				case 'image/png':
					imagepng($NewCanves,$DestFolder);
					break;
				case 'image/gif':
					imagegif($NewCanves,$DestFolder);
					break;			
				case 'image/jpeg':
				case 'image/pjpeg':
					imagejpeg($NewCanves,$DestFolder,$Quality);
					break;
				default:
					return false;
			}
	
			if(is_resource($NewCanves)) {imagedestroy($NewCanves);} 
			
			return true;
		}  
	}