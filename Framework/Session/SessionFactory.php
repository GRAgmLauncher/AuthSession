<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */
namespace Framework\Session;

class SessionFactory
{
	public function make()
	{
		return new \Framework\Session\Session;
	}
}

?>