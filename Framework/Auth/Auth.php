<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Auth;

class Auth
{
	/** int */
	public $id;
	
	/** int */
	public $user_id;
	
	/** int */
	public $registered;
	
	/** string */
	public $email;
	
	/** string */
	public $hash;
	
	public function verifyPassword($password) {
		return password_verify($password, $this->hash);
	}
	
	public function hashPassword($password) {
		$this->hash = password_hash($password, PASSWORD_DEFAULT, array('cost' => PASSWORD_WORKFACTOR));
	}
	
	public function mapUser(\Framework\Interfaces\UserInterface $User) {
		$this->user_id = $User->id;
		$this->email = $User->email;
		$this->registered = time();
	}
	
	public function rehashPassword($password) {
		if (password_needs_rehash($this->hash, PASSWORD_DEFAULT, array('cost' => PASSWORD_WORKFACTOR))) {
			$this->hashPassword($password);
			return true;
		}
		return false;
	}
}

?>