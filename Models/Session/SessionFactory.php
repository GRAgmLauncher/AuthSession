<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */
namespace Models\Session;

class SessionFactory
{
	public function make()
	{
		return new \Models\Session\Session;
	}
}

?>