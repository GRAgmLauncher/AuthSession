<?php

namespace Framework\Router;

class Dispatcher {
	
	private $controller;
	private $action;
	
	public function dispatch(\Framework\Router\Route $Route) {
		$bits = explode('->', $Route->handler);
		$this->controller = $bits[0];
		$this->action = $bits[1];
	}
	
	public function getView() {
		$controller = strtolower(str_replace('Controller', '', $this->controller));
		return $controller.DIRECTORY_SEPARATOR.$this->action;
	}
	
	public function getControllerBaseName() {
		return $this->Controller;
	}
	
	public function getControllerFullName() {
		return "Controllers\\{$this->controller}";
	}
	
	public function getControllerAction() {
		return $this->action;
	}
}

?>