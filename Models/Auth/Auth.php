<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Models\Auth;

class Auth extends \Core\DomainObject
{
	public $id;
	public $user_id;
	public $registered;
	public $email;
	public $hash;
	
	public function verifyPassword($password) {
		return password_verify($password, $this->hash);
	}
	
	public function hashPassword($password) {
		$this->hash = password_hash($password, PASSWORD_DEFAULT);
	}
	
	public function mapUser(\Interfaces\UserInterface $User) {
		$this->user_id = $User->getID();
		$this->email = $User->email;
		$this->registered = time();
	}
}

?>