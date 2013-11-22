function createImage($imagedata){

		// take image from URL (passed as $imagedata) and save to uploads directory 
		$upload_dir = ($_SERVER['DOCUMENT_ROOT'] .'/uploads/');
        	$filename =generateFilename().'.jpg';
        	$filelocation=$upload_dir . $filename;
		file_put_contents($filelocation,file_get_contents($imagedata));
		$localimage = $filename;
		
		// create variables for background image and watermark
		$dest = imagecreatefromjpeg('background.jpg');
		$src = imagecreatefrompng('overlay.png');
		
		// save PNG alpha info
		imagesavealpha($src, true); 
		imagealphablending($src, true);
		imagesavealpha($dest, true); 
		imagealphablending($dest, true);
		
		// find image sizes
		list($newwidth, $newheight, $type, $attr) = getimagesize('overlay.png');

		//combine both images
		imagecopyresampled($dest, $src, 200 , 100, 0, 0, $newwidth , $newheight, $newwidth , $newheight); 
		
		//output merged image to server
		//header('Content-Type: image/png');
		imagepng($dest, $localimage);
		
		// clear from memory
		imagedestroy($dest);
		imagedestroy($src);
		//return($dest);
}
