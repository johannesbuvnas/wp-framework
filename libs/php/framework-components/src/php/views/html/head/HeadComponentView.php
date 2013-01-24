<?php

class HeadComponentView extends ComponentView
{

	public $scripts;

	public $googleAnalytics;

	function __construct()
	{
		$this->_templateReference = "html/head/default-head";

		$this->scripts = Framework::factory( "DataProviderOutputComponentView" );

		$this->googleAnalytics = Framework::factory( "GoogleAnalyticsComponentView" );
	}
	
	public function addScript($script)
	{
		return $this->scripts->addElement( $script );
	}

	public function getOutput()
	{
		$this->_templateDataProvider = array(
				"scripts" => $this->scripts,
				"googleAnalytics" => $this->googleAnalytics
			);

		return parent::getOutput();
	}
}

?>