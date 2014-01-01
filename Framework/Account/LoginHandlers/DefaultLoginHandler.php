<?php

namespace Framework\Account\LoginHandlers;

class DefaultLoginHandler extends AbstractLoginHandler
{
	public function login($email, $password) {	
		if (!$Auth = $this->AuthMapper->fetchWhere('email', $email)) {
			throw new \Exception('User does not exist', 0);
		}

		if (!$Auth->verifyPassword($password)) {
			throw new \Exception('Password invalid', 1);
		}
		
		if ($Auth->rehashPassword($password)) {
			$this->AuthMapper->save($Auth);
		}
		
		$User = $this->UserMapper->fetchById($Auth->user_id);		// Get full user data from the auth id
		$this->SessionManager->createSession($User);				// Begin a new session
	}
}
?>