<?php

class GoogleAnalyticsComponentView extends ComponentView
{
	
	public $id = "";

	function __construct()
	{
		$this->_templateReference = "html/head/google-analytics";
	}

	public function getOutput()
	{
		$this->_templateDataProvider = array(
				"id" => $this->id
			);

		return parent::getOutput();
	}
	
	public function render()
	{
		if(DEVELOPMENT_MODE) return;
		
		else parent::render();
	}
}

?>