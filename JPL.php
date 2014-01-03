<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

class JPL
{
	protected $routes;
	protected $Injector;
	
	public function __construct(Array $routes, \Framework\AutoInjector $Injector) {
		$this->routes = $routes;
		$this->Injector = $Injector;
	}
	
	public function run() {
		
		// Start the session, and load framework helpers/components
		$Session 			= $this->Injector->create('Framework\Session\SessionManager')->initializeSession();
		$Input 				= $this->Injector->create('Framework\Inputer\Input');					  
		$Template 			= $this->Injector->create('Views\Template');
		$Flash				= $this->Injector->create('Framework\Flasher\Flash');
		$Redirect			= $this->Injector->create('Framework\Redirect');
		$Permissions		= $this->Injector->create('Framework\Security\PermissionChecker', array($Session));
		$Request			= $this->Injector->create('Framework\Request');
		$TabHelper			= $this->Injector->create('Framework\Helpers\Tabs\TabHelper');

		// Run the router
		$Router = $this->Injector->create('Framework\Router\Router');
		$Router->setRoutes($this->routes);
		$Route = $Router->getMatchedRoute();

		
		// Dispatch the route (e.g. get the controller name and action)
		$Dispatcher = $this->Injector->create('Framework\Router\Dispatcher');
		$Dispatcher->dispatch($Route);
		$controller = $Dispatcher->getControllerFullName();
		$action = $Dispatcher->getControllerAction();
		$view = $Dispatcher->getView();
		
		// Load the controller, and inject common dependencies. Call the controller action.
		$Controller = $this->Injector->create($controller);
		$Controller->setSession($Session);
		$Controller->setInput($Input);
		$Controller->setTemplate($Template);
		$Controller->setFlasher($Flash);
		$Controller->setRedirect($Redirect);
		$Controller->setPermissionChecker($Permissions);
		$Controller->setRouteParameters($Route->parameters);
		$Controller->setRequest($Request);
		$Controller->$action();

		
		// Do final template assignments, and then render the view
		$Template->assign('Session', $Session);
		$Template->assign('Flash', $Flash->getMessage());
		$Template->assign('thispage', $Request->getURI());
		$Template->assign('TabHelper', $TabHelper);
		$Template->render($view);
	}
}

?>