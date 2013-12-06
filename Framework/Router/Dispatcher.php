<?php

namespace Framework\Router;

class Dispatcher {
	
	public $Factory;
	
	public function __construct(\Controllers\ControllerFactory $Factory ) {
		$this->Factory = $Factory;
	}
	
	public function dispatch(\Framework\Router\Route $Route) {
		$bits = explode('->', $Route->handler);
		
		$controller = $this->Factory->make($bits[0]);
		
		$r = new \ReflectionClass($controller);
		$controllerName = strtolower(str_replace('Controller', '', $r->getShortName()));
		
		$action = $bits[1];
		
		$controller->$action();
		$controller->render("{$controllerName}/{$action}");
	}
}

?>