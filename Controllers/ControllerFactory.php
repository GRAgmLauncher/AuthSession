<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Controllers;

class ControllerFactory
{
	public function make($controllerName) {
		$controller = '\\Controllers\\'.$controllerName;
		return new $controller();
	}
}

?>