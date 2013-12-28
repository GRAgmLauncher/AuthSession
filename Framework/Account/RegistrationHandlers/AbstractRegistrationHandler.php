<?php

namespace Framework\Account\RegistrationHandlers;

abstract class AbstractRegistrationHandler
{
	protected $SessionManager;
	protected $AuthMapper;
	protected $AuthPrototype;
	protected $UserMapper;
	protected $UserPrototype;
	
	public function __construct
	(
		\Framework\Session\SessionManager $SessionManager, 
		\Framework\Auth\AuthMapper $AuthMapper,
		\Framework\Auth\Auth $AuthPrototype,
		\Models\User\UserMapper $UserMapper, 
		\Models\User\User $UserPrototype
	) 
	{
		$this->SessionManager = $SessionManager;
		$this->AuthMapper = $AuthMapper;
		$this->AuthPrototype = $AuthPrototype;
		$this->UserMapper = $UserMapper;
		$this->UserPrototype = $UserPrototype;
	}
	
	abstract public function register($username, $email, $password);
}

?>