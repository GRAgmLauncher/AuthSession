<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Core;

class CSRF {
	
	protected $Input;
	protected $Redirect;
	
	public function __construct(\Core\Input $Input, \Core\Redirect $Redirect) {
		$this->Input = $Input;
		$this->Redirect = $Redirect;
	}
	
	public function makeToken() {
		$token = array();
		$token['key'] = 'csrf_token:'.hash('sha512', (mt_rand() . time() . session_id()));
		$token['value'] = hash('sha512', (mt_rand() . microtime(true) . session_id()));
		
		$this->killToken();
		$this->setToken($token['key'], $token['value']);
		return $token;
	}
	
	public function checkToken() {
		$sessionToken = $this->getSessionValue($this->getInputKey());
		$inputToken = $this->getInputValue($this->getSessionKey());
		if ($sessionToken !== false) { 
			if ($inputToken !== false) {
				if ($sessionToken === $inputToken) {
					$this->killToken();
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
	
	private function killToken() {
		unset($_SESSION['csrf_token']);
	}
	
	private function setToken($key, $value) {
		$_SESSION['csrf_token'][$key] = $value;
	}
	
	private function getInputValue($key) {
		if (isset($this->Input[$key])) {
			return $this->Input[$key];
		}
		return false;
	}
}

?>