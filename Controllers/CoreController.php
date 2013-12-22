<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Controllers;

class CoreController
{
	protected $Session;
	protected $Template;
	protected $Input;
	protected $Flash;
	protected $Redirect;
	protected $Bounce;
	protected $Params;
	protected $Request;
	
	public function setSession(\Framework\Session\Session $Session) {
		$this->Session = $Session;
	}
	
	public function setTemplate(\Views\Template $Template) {
		$this->Template = $Template;
	}
	
	public function setInput(\Framework\Inputer\Input $Input) {
		$this->Input = $Input;
	}
	
	public function setFlasher(\Framework\Flasher\Flash $Flash) {
		$this->Flash = $Flash;
	}
	
	public function setRedirect(\Framework\Redirect $Redirect) {
		$this->Redirect = $Redirect;
	}
	
	public function setPermissionChecker(\Framework\Security\PermissionChecker $PermissionChecker) {
		$this->PermLevel = $PermissionChecker;
	}
	
	public function setRouteParameters(Array $parameters) {
		$this->Params = $parameters;
	}
	
	public function setRequest(\Framework\Request $Request) {
		$this->Request = $Request;
	}
}

?>