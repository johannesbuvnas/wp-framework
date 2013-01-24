<?php

class BodyComponentView extends ComponentView
{
	public $content = "";

	function __construct()
	{
		$this->_templateReference = "html/body/default-body";
	}
	
	public function getOutput()
	{
		$this->_templateDataProvider = array(
			'content' => $this->content
		);
		
		return parent::getOutput();
	}
}

?>