<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Security;

class CSRFManager {
	
	protected $Input;
	protected $Redirect;
	protected $SecurityHelper;
	
	public function __construct(\Framework\Input\Input $Input, \Framework\Redirect $Redirect, \Framework\Security\SecurityHelper $SecurityHelper) {
		$this->Input = $Input;
		$this->Redirect = $Redirect;
		$this->SecurityHelper = $SecurityHelper;
	}
	
	public function makeToken() {
		
		$key = 'csrf_token:'.$this->SecurityHelper->randomString(128);
		$value = $this->SecurityHelper->randomString(128);
		$Token = new \Framework\Security\CSRFToken($key, $value);
		
		$this->killCurrentToken();
		$this->setNewToken($Token);
		return $Token;
	}
	
	public function checkToken() {
		$sessionToken = $this->getSessionValue($this->getInputKey()); 	// Use the input key to get the session value
		$inputToken = $this->getInputValue($this->getSessionKey()); 	// Use the session key to get the input value
		
		if ($sessionToken !== false) { 
			if ($inputToken !== false) {
				if ($sessionToken === $inputToken) {
					$this->killCurrentToken();
					return;
				}
			}
		}
		$this->Redirect->withMessage('Invalid Token', 'red');
	}
	
	private function getSessionKey() {
		return key($_SESSION['csrf_token']);
	}
	
	private function getSessionValue($key) {
		if (isset($_SESSION['csrf_token'][$key])) {
			return $_SESSION['csrf_token'][$key];
		}
		return false;
	}
	
	private function getInputKey() {
		foreach ($this->Input as $key => $value) {
			if (preg_match('#csrf_token:#', $key)) {
				return $key;
			}
		}
	}
	
	private function getInputValue($key) {
		if (isset($this->Input[$key])) {
			return $this->Input[$key];
		}
		return false;
	}
	
		
	private function killCurrentToken() {
		unset($_SESSION['csrf_token']);
	}
	
	private function setNewToken(\Framework\Security\CSRFToken $token) {
		$_SESSION['csrf_token'][$token->key] = $token->value;
	}
}

?>