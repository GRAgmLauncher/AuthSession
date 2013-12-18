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
		$CurrentSession 	= $this->Injector->create('Framework\Session\SessionManager')->initializeSession();
		$CurrentUser 		= $this->Injector->create('Models\User\UserMapper')->fetchByID($CurrentSession->user_id);
		$CleanedInput 		= $this->Injector->create('Framework\Inputer\InputCleaner')->scrub();
							  $this->Injector->register('Framework\Inputer\Input', $CleanedInput);					  
		$Template 			= $this->Injector->create('Views\Template');
		$Flash				= $this->Injector->create('Framework\Flasher\Flash');
		$Redirect			= $this->Injector->create('Framework\Redirect');
		
		
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
		$Controller->setCurrentSession($CurrentSession);
		$Controller->setCurrentUser($CurrentUser);
		$Controller->setInput($CleanedInput);
		$Controller->setTemplate($Template);
		$Controller->setFlasher($Flash);
		$Controller->setBouncer($Redirect);
		$Controller->$action();
		
		
		// Do final template assignments, and then render the view
		$Template->assign('CurrentUser', $CurrentUser);
		$Template->assign('CurrentSession', $CurrentSession);
		$Template->assign('Flash', $Flash->getMessage());
		$Template->render($view);
	}
}

?>