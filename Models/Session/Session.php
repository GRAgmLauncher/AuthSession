<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Models\Session;

class Session extends \Core\DomainObject implements \Interfaces\SessionInterface
{
	public $id;
	public $user_id;
	public $group_id;
	public $time_stamp;
	
	public function populate(\Models\User\User $User = null) {
		
		$this->regenerateID();
		$this->updateTimestamp();
		
		if ($User) {
			$this->mapUser($User);
		} else {
			$this->mapGuest();
		}

	}
	
	protected function mapUser(\Models\User\User $User) {
		$this->user_id = $User->getID();
		$this->group_id = $User->group_id;
	}
	
	protected function mapGuest() {
		$this->user_id = 0;
		$this->group_id = 2;
	}
	
	public function updateTimestamp() {
		$this->time_stamp = time();
	}
	
	public function regenerateID() {
		session_regenerate_id(true);
		$this->id = session_id();
	}
}

?>