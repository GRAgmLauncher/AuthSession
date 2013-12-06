<?php

namespace Framework\Router;

class Route 
{
	public $uri;
	public $pattern;
	public $parameters = array();
	public $handler;
	
	public function __construct($uri, $handler) {
		$this->uri = $uri;
		$this->handler = $handler;
		$this->makePatternFromURI();
	}
	
	public function addParams(Array $params) {
		foreach ($params as $key => $value) {
			if (!is_numeric($key)) {
				$this->addParam($key, $value);
			}
		}
	}
	
	public function addParam($key, $value) {
		$this->parameters[$key] = $value;
	}
		
	protected function makePatternFromURI() {
		$parts = explode('/', $this->uri);
		foreach($parts as $key => $part) {
			if (substr($part, 0, 1) == ':') {
				$name = substr($part, 1);
				$parts[$key] = "(?<$name>[a-zA-Z0-9]+)";
			}
		}
		$pattern = implode('/', $parts);
		$this->pattern = "#^{$pattern}$#";
	}
}



?>