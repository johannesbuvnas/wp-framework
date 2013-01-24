<?php

class ArrayUtil
{
	/**
	*	Returns array without the forbidden elements.
	*/
	public static function removeForbiddenElements($array, $forbiddenElements)
	{
		$i = 0;
		
		foreach($array as $element)
		{
			$indexOf = array_search( $element, $forbiddenElements);
			
			if(is_numeric( $indexOf )) 
			{
				unset( $array[$i] );
			}
			
			$i++;
		}
		
		return $array;
	}
}

?>