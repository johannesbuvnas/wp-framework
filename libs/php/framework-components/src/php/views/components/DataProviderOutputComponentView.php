<?php

class DataProviderOutputComponentView extends ComponentView
{

	public $dataProvider;
	
	function __construct()
	{
		$this->_templateReference = "components/dataprovider-output";

		$this->dataProvider = array(
			);
	}

	/* PUBLIC METHODS */
	public function addElement($element)
	{
		$this->dataProvider[] = $element;
	}

	public function getOutput()
	{
		$this->_templateDataProvider = array(
				"dataProvider" => $this->dataProvider
			);

		return parent::getOutput();
	}
}

?>