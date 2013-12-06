<?php

namespace Framework\Account\RegistrationHandlers;

abstract class AbstractRegistrationHandler
{
	protected $SessionManager;
	protected $AuthMapper;
	protected $AuthFactory;
	protected $UserMapper;
	protected $UserFactory;
	
	public function __construct
	(
		\Framework\Session\SessionManager $SessionManager, 
		\Framework\Auth\AuthMapper $AuthMapper,
		\Framework\Auth\AuthFactory $AuthFactory,
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
	
	abstract public function register($username, $email, $password);
}

?>