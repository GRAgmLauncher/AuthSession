<?php

namespace Framework\Account\LoginHandlers;

abstract class AbstractLoginHandler
{
	protected $SessionManager;
	protected $AuthMapper;
	protected $UserMapper;
	
	public function __construct
	(
		\Framework\Session\SessionManager $SessionManager, 
		\Framework\Auth\AuthMapper $AuthMapper,
		\Models\User\UserMapper $UserMapper
	) 
	{
		$this->SessionManager = $SessionManager;
		$this->AuthMapper = $AuthMapper;
		$this->UserMapper = $UserMapper;
	}
	
	abstract public function login($identifier, $password);
}

?>