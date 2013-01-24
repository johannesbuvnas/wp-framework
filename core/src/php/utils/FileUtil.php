<?php

class FileUtil
{	
	public static function fixPath($filename)
	{		
		$filename = str_replace("\\", "/", $filename);
		
		$filename = str_replace("//", "/", $filename);
		
		if(substr( $filename, strlen( $filename ) - 1, 1 ) == "/") $filename = substr( $filename, 0, strlen( $filename ) - 1 );
		
		return $filename;
	}
}

?>