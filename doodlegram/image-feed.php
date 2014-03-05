<?php 
	if ( $handle = opendir( 'images' ) ) {
        while (false !== ($entry = readdir($handle))) {
            if ( $entry != "." && $entry != "..") {
                echo "<img src='images/$entry' width=320 height=320>";
            }
        }
        closedir( $handle );
   }