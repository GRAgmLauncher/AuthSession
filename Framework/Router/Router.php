<?php

namespace Framework\Router;

class Router {
	
	protected $routes = array();
	protected $Request;
	protected $RouteFactory;
	protected $matchedRoute = null;
	
	public function __construct(\Framework\Request $Request, \Framework\Router\RouteFactory $RouteFactory) {
		$this->Request = $Request;
		$this->RouteFactory = $RouteFactory;
	}

	public function setRoute($uri, $handler) {
		$Route = $this->RouteFactory->make($uri, $handler);
		$this->routes[$uri] = $Route;
	}
	
	
	/**
	 * @return Route $Route
	 **/
	 
	public function getMatchedRoute() {
		
		$uri = $this->Request->getURI();
		$match_count = 0;
		
		foreach($this->routes as $Route) {
			if (preg_match($Route->pattern, $uri, $matches) == 1) {
				$Route->addParams($matches);
				$this->matchedRoute = $Route;
				$match_count++;
				break;
			}
		}
		
		if ($match_count == 0) {
			header('Location: /404');
		}
			
		return $this->matchedRoute;	
	}
}


?>