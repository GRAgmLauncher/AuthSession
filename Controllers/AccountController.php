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
	protected $FormHelper;
	
	public function __construct
	(
		\Framework\Account\LoginHandlers\AbstractLoginHandler $LoginHandler,
		\Framework\Account\LogoutHandlers\AbstractLogoutHandler $LogoutHandler,
		\Framework\Account\RegistrationHandlers\AbstractRegistrationHandler $RegistrationHandler,
		\Framework\Helpers\Form\FormHelper $FormHelper
	) 
	{
		$this->LoginHandler = $LoginHandler;
		$this->LogoutHandler = $LogoutHandler;
		$this->RegistrationHandler = $RegistrationHandler;
		$this->FormHelper = $FormHelper;
	}
	
	public function login() {
		
		if ($this->Session->User->isLoggedIn()) {
			$this->Redirect->to('/');
		}
		
		$this->FormHelper->textField('email', 'Email...')->rules('required');
		$this->FormHelper->passwordField('password', 'Password...')->rules('required');
		$this->FormHelper->submitField('submit', 'Login', 'button green pressdown noicon loginSubmit');

		if ($this->FormHelper->validate()) {
			try {
				$this->LoginHandler->login($this->Input['email'], $this->Input['password']);
				$this->Redirect->to('/');
			} 
			catch (\Exception $e) {
				
				if ($e->getCode() == 0) {
					$this->FormHelper->setFieldError('email', $e->getMessage());
				}
				
				if ($e->getCode() == 1) {
					$this->FormHelper->setFieldError('password', $e->getMessage());
				}
			}
		}
		
		$this->Template->assign('Form', $this->FormHelper);
	}
	
	public function logout() {
		$this->LogoutHandler->logout();
		$this->Redirect->to('/');
	}
	
	public function register() {
		if ($this->Input['register']) {
			$this->RegistrationHandler->register($this->Input['username'], $this->Input['email'], $this->Input['password']);
			$this->Redirect->withMessage('Account created', 'green', '/');
		}
	}
}

?>