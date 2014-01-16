<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Models\User;

class User
{
	/** int */
	public $id;

	/** string */
	public $first_name;
	
	/** string */
	public $last_name;
	
	/** \Models\Group\Group */
	public $Group;
	
	/** \Models\User\Account */
	public $Account;
	
	public function __construct(\Models\Group\Group $Group, \Models\User\Account $Account) {
		$this->Group = $Group;
		$this->Account = $Account;
		
		// I am a guest to start with
		$this->id = 0;
		$this->first_name = 'guest';
		$this->last_name = 'guest';
	}
	
	public function isAdmin() {
		if ($this->Group->permission_level == 10) {
			return true;
		}
		return false;
	}
	
	public function isLoggedIn() {
		if ($this->id > 0) {
			return true;
		}
		return false;
	}
}

?>