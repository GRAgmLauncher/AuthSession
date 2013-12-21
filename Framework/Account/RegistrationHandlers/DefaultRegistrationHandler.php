<?php

namespace Framework\Account\RegistrationHandlers;

class DefaultRegistrationHandler extends AbstractRegistrationHandler
{
	public function register($username, $email, $password) {
		if ($this->AuthMapper->fetchWhere('email', $email)) {
			throw new \Exception('User already exists');
		}
		
		$User = $this->UserFactory->make();
		$User->display_name = $username;
		$User->login_name = $username;
		$User->email = $email;
		$User->group_id = 2;
		$User = $this->UserMapper->save($User); 	// Returns the saved object with the insert ID
		
		$Auth = $this->AuthFactory->make();
		$Auth->mapUser($User);
		$Auth->hashPassword($password);
		$this->AuthMapper->save($Auth);
		
		$this->SessionManager->createSession($User);
	}
}

?>