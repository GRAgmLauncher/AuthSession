<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Models\User;

class User implements \Framework\Interfaces\UserInterface
{
	/** int */
	public $id;

	/** string */
	public $display_name;
	
	/** string */
	public $login_name;
	
	/** string */
	public $email;
	
	/** int */
	public $group_id;
	
	/** \Models\Group\Group */
	public $Group;
	
	public function __construct(\Models\Group\Group $Group) {
		$this->Group = $Group;
		
		// I am a guest to start with
		$this->id = 0;
		$this->group_id = 3;
		$this->login_name = 'guest';
		$this->display_name = 'guest';
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