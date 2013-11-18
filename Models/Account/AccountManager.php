<?php

namespace Models\Account;

class AccountManager
{
	protected $SessionManager;
	protected $AuthMapper;
	protected $AuthFactory;
	protected $UserMapper;
	protected $UserFactory;
	
	public function __construct
	(
		\Models\Session\SessionManager $SessionManager, 
		\Models\Auth\AuthMapper $AuthMapper,
		\Models\Auth\AuthFactory $AuthFactory,
		\Models\User\UserMapper $UserMapper, 
		\Models\User\UserFactory $UserFactory
	) 
	{
		$this->SessionManager = $SessionManager;
		$this->AuthMapper = $AuthMapper;
		$this->AuthFactory = $AuthFactory;
		$this->UserMapper = $UserMapper;
		$this->UserFactory = $UserFactory;
	}
	
	public function login($email, $password) {	
		if (!$Auth = $this->AuthMapper->fetchWhere('email', $email)) {
			throw new \Exception('User does not exist');
		}

		if (!$Auth->verifyPassword($password)) {
			throw new \Exception('Password invalid');
		}
		
		if ($Auth->rehashPassword($password)) {
			$this->AuthMapper->save($Auth);
		}
		
		$User = $this->UserMapper->fetchById($Auth->user_id);		// Get full user Mapper from the auth id
		$this->SessionManager->createSession($User);				// Begin a new session
		header("Location: /");
	}
	
	
	
	public function logout() {
		$this->SessionManager->endCurrentSession();				// End the current session
		header("Location: /");
	}
	
	
	
	public function register($username, $email, $password) {
		if ($this->AuthMapper->fetchWhere('email', $email)) {
			echo 'user already exists!';
			return;
		}
		
		$User = $this->UserFactory->make();
		$User->display_name = $username;
		$User->login_name = $username;
		$User->email = $email;
		$User->group_id = 3;
		
		$User = $this->UserMapper->save($User); 	// Returns the saved object with the insert ID
		
		$Auth = $this->AuthFactory->make();
		$Auth->mapUser($User);
		$Auth->hashPassword($password);
		
		$this->AuthMapper->save($Auth);
		
		$this->SessionManager->createSession($User);
		
		header("Location: /");
	}
	
	public function resetPassword() {}
}

?>