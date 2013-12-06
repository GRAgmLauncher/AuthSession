<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

class JPL
{
	protected $Services;
	
	public function __construct(\Pimple $Services, Array $routes) {
		$this->Services = $Services;
		$this->addRoutes($routes);
	}
	
	private function addRoutes(Array $routes) {
		foreach ($routes as $uri => $closure) {
			$this->route($uri, $closure);
		}
	}
	
	public function route($uri, $closure) {
		$this->Services['Router']->setRoute($uri, $closure);
	}
	
	public function run() {
		
		$this->Services['CurrentSession'] 	= $this->Services['SessionManager']->initializeSession();
		$this->Services['CurrentUser'] 		= $this->Services['UserMapper']->fetchByID($this->Services['CurrentSession']->user_id);
		$this->Services['Input'] 			= $this->Services['InputCleaner']->scrub();
		$this->Services['Route'] 			= $this->Services['Router']->getMatchedRoute();
		$this->Services['Params']			= $this->Services['Route']->parameters;
		$this->Services['Dispatcher']->dispatch($this->Services['Route']);
	}
}

?>