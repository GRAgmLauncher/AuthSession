<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Session;

class Session implements \Framework\Interfaces\SessionInterface
{
	/** int */
	public $id;
	
	/** int */
	public $user_id;
	
	/** int */
	public $group_id;
	
	/** int */
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
		$this->user_id = $User->id;
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