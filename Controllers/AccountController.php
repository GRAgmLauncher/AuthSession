<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Controllers;

class AccountController extends \Controllers\CoreController
{
	protected $CSRFManager;
	protected $LoginHandler;
	protected $LogoutHandler;
	
	public function __construct
	(
		\Framework\Security\CSRFManager $CSRFManager, 
		\Framework\Account\LoginHandlers\AbstractLoginHandler $LoginHandler,
		\Framework\Account\LogoutHandlers\AbstractLogoutHandler $LogoutHandler
	) 
	{
		$this->CSRFManager = $CSRFManager;
		$this->LoginHandler = $LoginHandler;
		$this->LogoutHandler = $LogoutHandler;
	}
	
	public function login() {
		
		if ($this->Input['login']) {
			$this->CSRFManager->checkToken();
			$this->LoginHandler->login($this->Input['email'], $this->Input['password']);
			$this->Redirect->withMessage('Yay logged in!', 'green', '/');
		}
		
		$this->Template->assign('CSRFToken', $this->CSRFManager->makeToken());
	}
	
	public function logout() {
		$this->LogoutHandler->logout();
		$this->Redirect->to('/login');
	}
}

?>