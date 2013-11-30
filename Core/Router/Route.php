<?php

namespace Core\Router;

class Route 
{
	public $uri;
	public $pattern;
	public $parameters = array();
	public $closure;
	
	public function __construct() {
		$this->uri = '/404';
		$this->makePattern();
		$this->setClosure('DefaultController->error404');
	}
	
	public function setPattern($pattern) {
		return $this->pattern = "#^{$pattern}$#";
	}
	
	public function setURI($uri) {
		$this->uri = $uri;
	}
	
	public function setClosure($closure) {
		$this->closure = $closure;
	}
	
	public function makePattern() {
		$parts = explode('/', $this->uri);
		foreach($parts as $key => $part) {
			if (substr($part, 0, 1) == ':') {
				$name = substr($part, 1);
				$parts[$key] = "(?<$name>[a-zA-Z0-9]+)";
			}
		}
		return $this->setPattern(implode('/', $parts));
	}
	
	public function addParams($params) {
		foreach ($params as $key => $value) {
			if (!is_numeric($key)) {
				$this->addParam($key, $value);
			}
		}
	}
	
	public function addParam($key, $value) {
		$this->parameters[$key] = $value;
	}
}



?>