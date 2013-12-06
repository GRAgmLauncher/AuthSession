<?php

namespace Framework\Account\LogoutHandlers;

abstract class AbstractLogoutHandler
{
	protected $SessionManager;
	
	public function __construct( \Framework\Session\SessionManager $SessionManager ) {
		$this->SessionManager = $SessionManager;
	}
	
	abstract public function logout();
}

?>