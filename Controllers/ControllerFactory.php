<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Controllers;

class ControllerFactory
{
	protected $Services;
	
	public function __construct($Services) {
		$this->Services = $Services;
	}
	
	public function make($controllerName) {
		$controller = '\\Controllers\\'.$controllerName;
		return new $controller($this->Services);
	}
}

?>