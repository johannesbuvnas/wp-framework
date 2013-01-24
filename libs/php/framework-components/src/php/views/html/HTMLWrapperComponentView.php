<?php

class HTMLWrapperComponentView extends ComponentView
{
	public $head;

	public $body;


	function __construct()
	{
		$this->_templateReference = "html/default-html-wrapper";
	}

	public function getOutput()
	{
		$this->_templateDataProvider = array(
				"head" => $this->head,
				"body" => $this->body
			);

		return parent::getOutput();
	}
}

?>