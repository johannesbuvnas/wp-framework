<?php
	
class DebugView extends View
{

	public $message;

	public $classes = "";
	
	function __construct()
	{
		$this->_templateReference = "debugger/debugger";
	}

	/* PUBLIC METHODS */
	public function getOutput()
	{
		$this->_templateDataProvider = array(
			"message" => $this->message,
			"classes" => $this->classes
			);

		return parent::getOutput();
	}

	/* PRIVATE METHODS */
	protected function getTemplatePath()
	{
		return Framework::getAbsolutePath( "core/templates/".$this->_templateReference.'.php' );
	}
}

?>