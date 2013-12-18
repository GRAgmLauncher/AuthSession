<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Controllers;

class CoreController
{
	protected $CurrentUser;
	protected $CurrentSession;
	protected $Template;
	protected $Input;
	protected $Flash;
	protected $Redirect;
	
	public function setCurrentSession(\Framework\Session\Session $CurrentSession) {
		$this->CurrentSession = $CurrentSession;
	}
	
	public function setCurrentUser($CurrentUser) {
		$this->CurrentUser = $CurrentUser;
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
	
	public function setBouncer(\Framework\Redirect $Redirect) {
		$this->Redirect = $Redirect;
	}
}

?>