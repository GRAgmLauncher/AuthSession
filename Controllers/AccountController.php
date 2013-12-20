<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Controllers;

class AccountController extends \Controllers\CoreController
{
	protected $LoginHandler;
	protected $LogoutHandler;
	protected $RegistrationHandler;
	
	public function __construct
	(
		\Framework\Account\LoginHandlers\AbstractLoginHandler $LoginHandler,
		\Framework\Account\LogoutHandlers\AbstractLogoutHandler $LogoutHandler,
		\Framework\Account\RegistrationHandlers\AbstractRegistrationHandler $RegistrationHandler
	) 
	{
		$this->LoginHandler = $LoginHandler;
		$this->LogoutHandler = $LogoutHandler;
		$this->RegistrationHandler = $RegistrationHandler;
	}
	
	public function login() {
		debug($this->Input['login']);
		if ($this->Input['login']) {
			$this->LoginHandler->login($this->Input['email'], $this->Input['password']);
			$this->Redirect->withMessage('Yay logged in!', 'green', '/');
		}
	}
	
	public function logout() {
		$this->LogoutHandler->logout();
		$this->Redirect->to('/login');
	}
	
	public function register() {
		if ($this->Input['register']) {
			$this->RegistrationHandler->register($this->Input['username'], $this->Input['email'], $this->Input['password']);
			$this->Redirect->withMessage('Account created', 'green', '/');
		}
	}
}

?>