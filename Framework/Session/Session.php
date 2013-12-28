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
	public $time_stamp;
	
	/** int */
	public $user_id;
	
	/** \Models\User\User */
	public $User;
	
	
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
	}
	
	protected function mapGuest() {
		$this->user_id = 0;
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