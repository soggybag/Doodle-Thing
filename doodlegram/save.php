<?php  
	if ( isset($_POST["image"]) && !empty($_POST["image"]) ) { 
		// get the image data
		$data = $_POST['image'];
		// remove the prefix
		$uri = substr( $data, strpos( $data, "," ) + 1 );
		// create a filename for the new image
		$file = md5( uniqid() ) . '.png';
		// decode the image data and save it to file
		file_put_contents( "images/".$file, base64_decode($uri) );
		// return the filename
		require( "../web4/dbconnect.php" );
		$sql = "INSERT INTO doodle
		SET image='$file', user='1', tags='' ";
		$results = mysql_query( $sql );
		echo $sql;
	}