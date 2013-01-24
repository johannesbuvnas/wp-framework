<?php

class View
{
	protected $_templateReference;
	
	protected $_templateDataProvider;

	protected $_templateContent = "";
	
	
	public function __construct()
	{
	}
	
	/* PUBLIC METHODS */
	public function getOutput()
	{
		if(!isset($this->_templateReference) || !strlen($this->_templateReference))
		{	
			return "";
		}
		
		if($this->_templateDataProvider) extract( $this->_templateDataProvider, EXTR_SKIP);
		
		ob_start();
		
		$filename = $this->getTemplatePath();

		if( is_file( $filename ) )
		{
			include $filename;
		}
		else 
		{
			Framework::debug( get_class($this).":: No such file - ".$filename );
			
			return "";
		}

		$output = ob_get_clean();
		
		if($output == null) return "\n";
		else return $output;
	}
	
	public function render()
	{
		$output = $this->getOutput();
		
		if(empty( $output ))
		{
			Framework::debug( get_class($this).":: Output doesn't return anything." );
		}
		else
		{
			echo $output;
		}
		
		echo $this->_templateContent;
	}

	/* PRIVATE METHODS */
	protected function getTemplatePath()
	{
		return Framework::getAbsolutePath( "application/templates/".$this->_templateReference.'.php' );
	}

	protected function setTemplate($templateReference)
	{
		$this->_templateReference = $templateReference;
	}

	protected function setDataprovider($templateDataprovider)
	{
		$this->_templateDataProvider = $templateDataprovider;
	}
}

?>