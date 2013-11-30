<?php

namespace Core\Router;

class Dispatcher {
	
	public $Factory;
	
	public function __construct(\Controllers\ControllerFactory $Factory ) {
		$this->Factory = $Factory;
	}
	
	public function dispatch(\Core\Router\Route $Route) {
		if (is_string($Route->closure)) {
			$this->dispatchController($Route);
		} else {
			$this->dispatchClosure($Route);
		}
	}
	
	protected function dispatchController(\Core\Router\Route $Route) {
		$bits = explode('->', $Route->closure);
		$controller = $this->Factory->make($bits[0]);
		$controller->$bits[1]();
		$controller->render("{$bits[1]}/{$bits[1]}");
	}
	
	protected function dispatchClosure(\Core\Router\Route $Route) {
		call_user_func_array($Route->closure, array($Route->parameters));
	}
}


?>