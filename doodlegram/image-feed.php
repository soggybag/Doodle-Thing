<?php 
	/*
	if ( $handle = opendir( 'images' ) ) {
		while (false !== ($entry = readdir($handle))) {
			if ( $entry != "." && $entry != "..") {
				echo "<img src='images/$entry' width=320 height=320>";
			}
		}
		closedir( $handle );
	}*/
   
	require("../web4/dbconnect.php");
   /*
	$sql = "SELECT 
				doodle.date,
				doodle.image,
				doodle_user.username
	 		FROM 
	 			doodle,
	 			doodle_user 
	 		WHERE 
	 			doodle.user = doodle_user.id
	 		ORDER BY date DESC";
	 	*/
	 	
		$sql = "SELECT 
			*
		FROM 
			doodle
		ORDER BY date DESC";
		
	$results = mysql_query( $sql );
	while( $row = mysql_fetch_array($results) ) {
		echo "<div>
				<img src='images/{$row['image']}' width=320 height=320>
				<div>{$row['date']}</div>
			</div>";
	}