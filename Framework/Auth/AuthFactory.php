<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */
namespace Framework\Auth;

class AuthFactory
{
	public function make()
	{
		return new \Framework\Auth\Auth;
	}
}

?>