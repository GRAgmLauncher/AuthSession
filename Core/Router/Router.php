<?php

namespace Core\Router;

class Router {
	
	protected $routes = array();
	protected $Request;
	protected $RouteFactory;
	protected $matchedRoute = null;
	
	public function __construct(\Core\Request $Request, \Core\Router\RouteFactory $RouteFactory) {
		$this->Request = $Request;
		$this->RouteFactory = $RouteFactory;
	}

	public function setRoute($uri, $closure) {
		$Route = $this->RouteFactory->make();
		$Route->setURI($uri);
		$Route->setClosure($closure);
		$Route->makePattern();
		$this->routes[$uri] = $Route;
	}
	
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