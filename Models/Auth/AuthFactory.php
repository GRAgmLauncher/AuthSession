<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */
namespace Models\Auth;

class AuthFactory
{
	public function make()
	{
		return new \Models\Auth\Auth;
	}
}

?>