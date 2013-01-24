<?php

class BodyContentComponentView extends ComponentView
{
	public $pageHeader;
	
	public $pageBody;
	
	public $pageFooter;
	
	
	function __construct()
	{
		$this->_templateReference = "html/body/default-body-content";
	}
	
	public function getOutput()
	{
		$this->_templateDataProvider = array(
			"pageHeader" => $this->pageHeader,
			"pageBody" => $this->pageBody,
			"pageFooter" => $this->pageFooter
		);
		
		return parent::getOutput();
	}
}

?>