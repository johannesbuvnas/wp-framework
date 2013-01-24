<?php
// IMPORTS
require_once( FRAMEWORK_CORE_PHP_ROOT."utils/FrameworkUtil.php" );

class Framework
{
	/* VARS */
	protected static $initated = false;

	/* OBJECTS */
	protected static $frameworkService;


	public static function init()
	{	
		if(self::$initated) return;

		wp_register_script( 'framework-script', self::getURL( "core/scripts/js/framework.js" ), false, FRAMEWORK_VERSION );
    	wp_enqueue_script( 'framework-script' );
		
		if(DEVELOPMENT_MODE)
		{
			error_reporting( E_ERROR );
			ini_set( "display_errors", 1 );

			if(!wp_script_is("jquery"))
			{
				wp_register_script( 'jquery', "http://code.jquery.com/jquery-latest.min.js", false, FRAMEWORK_VERSION );
			}

			wp_enqueue_script( 'jquery' );

			wp_register_script( 'framework-debugger-script', self::getURL( "core/scripts/js/framework-debugger.js" ), false, FRAMEWORK_VERSION );
    		wp_enqueue_script( 'framework-debugger-script' );

    		wp_register_style( 'framework-css', self::getURL( "core/scripts/css/framework.css" ), false, FRAMEWORK_VERSION );
    		wp_enqueue_style( 'framework-css' );
		}
		else
		{
			error_reporting( 0 );
			
			ini_set( "display_errors", 0 );
		}
		
		self::handleImports();

		self::$frameworkService = new FrameworkService();
		
		self::$initated = true;
	}
	
	protected static function handleImports()
	{
		self::import( FRAMEWORK_CORE_PHP_ROOT, array("utils/", "Framework.php") );

		self::import( FRAMEWORK_APPLICATION_PHP_ROOT );
	}
	
	/* STATIC METHODS */
	public static function factory($classReference, $data = NULL)
	{
		$viewClass = new $classReference();
		
		if($data)
		{
			foreach($data as $key => $value)
			{
				$viewClass->$key = $value;
			}
		}
		
		return $viewClass;
	}
	
	/**
	*	Publish a debug message.
	*/
	public static function debug($message)
	{
		if(DEBUG_MODE)
		{
			self::factory("DebugView", array(
					"message" => $message
				))
			->render();
		}
	}

	/**
	*	Publish a message through javascript method: console.log.
	*/
	public static function console($message)
	{
		if(DEVELOPMENT_MODE)
		{
			self::factory("DebugView", array(
					"message" => $message,
					"classes" => "framework-debugger-console"
				))
			->render();
		}
	}
	
	/* FILE METHODS */
	////////////////////////////////////////////////////////////////////////////////////////
	/**
	*	Import into library scope.
	*/
	public static function import($library, $ignoredPaths = array())
	{
		$imports = self::getImportScope( $library, $ignoredPaths );

		foreach($imports as $import)
		{
			require_once( $import );
		}
	}

	/**
	*	Returns the absolute path of file / dir.
	*/
	public static function getAbsolutePath($path)
	{
		return FRAMEWORK_ROOT."/".$path;
	}

	/**
	*	Returns URL to a asset within the framework.
	*/
	public static function getURL($asset)
	{
		return FRAMEWORK_URL."/".$asset;
	}
	
	/**
	*	Collects all PHP-files within a directory and subdirectories.
	*	Returns array.
	*/
	public static function getImportScope($directory, $ignoredPaths = array(), $autofixPaths = true)
	{		
		if($autofixPaths)
		{
			$directory = FileUtil::fixPath( $directory );
			
			$i = 0;
		
			foreach($ignoredPaths as $path)
			{
				$ignoredPaths[$i] = FileUtil::fixPath( $directory."/".$path );
				$i++;
			}
		}
		
		$scripts = ArrayUtil::removeForbiddenElements( glob( $directory."/*.php" ), $ignoredPaths );
		
		$directories = ArrayUtil::removeForbiddenElements( glob( $directory."/*", GLOB_ONLYDIR ), $ignoredPaths );
		
		foreach($directories as $directory)
		{
			$scripts = array_merge( $scripts, self::getImportScope( $directory, $ignoredPaths, false ) );
		}
		
		return $scripts;
	}
	////////////////////////////////////////////////////////////////////////////////////////
}
?>