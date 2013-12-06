<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Controllers;

class AccountController extends \Controllers\CoreController
{
	public function login() {
		if ($this->Input['login']) {
			$this->CSRFManager->checkToken();
			$this->DefaultLoginHandler->login($this->Input['email'], $this->Input['password']);
			$this->Redirect->withMessage('Yay logged in!', 'green', '/');
		}
	}
	
	public function logout() {
		$this->DefaultLogoutHandler->logout();
		$this->Redirect->to('/login');
	}
}

?>