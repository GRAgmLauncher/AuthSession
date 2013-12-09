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
		
		$Router = $this->Injector->create('Framework\Router\Router');
		$Router->setRoutes($this->routes);
		
		$Route				= $Router->getMatchedRoute();
		$CurrentSession 	= $this->Injector->create('Framework\Session\SessionManager')->initializeSession();
		$CurrentUser 		= $this->Injector->create('Models\User\UserMapper')->fetchByID($CurrentSession->user_id);
		$CleanedInput 		= $this->Injector->create('Framework\Inputer\InputCleaner')->scrub();
							  $this->Injector->register('Framework\Inputer\Input', $CleanedInput);
							  
		$Template 			= $this->Injector->create('Views\Template');
		$Flash				= $this->Injector->create('Framework\Flasher\Flash');
		$Redirect			= $this->Injector->create('Framework\Redirect');
		$Dispatcher 		= $this->Injector->create('Framework\Router\Dispatcher');
		
		$Dispatcher->dispatch($Route);
		
		$Controller = $this->Injector->create($Dispatcher->getControllerFullName());
		$Template->setView($Dispatcher->getView());

		
		$Controller->setCurrentSession($CurrentSession);
		$Controller->setCurrentUser($CurrentUser);
		$Controller->setInput($CleanedInput);
		$Controller->setTemplate($Template);
		$Controller->setFlasher($Flash);
		$Controller->setBouncer($Redirect);
		
		$action = $Dispatcher->getControllerAction();
		$Controller->$action();
		$Controller->render();
	}
}

?>