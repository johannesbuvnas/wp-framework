<?php

class ComponentView extends View
{
	
	/* PRIVATE METHODS */
	protected function getTemplatePath()
	{
		return FRAMEWORK_LIBS_PHP_ROOT."/framework-components/templates/".$this->_templateReference.'.php';
	}
}

?>