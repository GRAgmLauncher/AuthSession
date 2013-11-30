<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Controllers;

class LoginController extends \Controllers\CoreController
{
	public function login() {
		if ($this->Input['login']) {
			$this->CSRF->checkToken();
			$this->AccountManager->login($this->Input['email'], $this->Input['password']);
			$this->Redirect->withMessage('Yay, Logged In!!', '/');
		}
	}
	
	public function logout() {
		$this->AccountManager->logout();
		$this->Redirect->to('/login');
	}
	
	public function test() {
		debug($this->Route);
	}
}

?>