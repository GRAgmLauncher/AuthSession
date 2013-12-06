<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Models\User;

class User implements \Framework\Interfaces\UserInterface
{
	/** int */
	public $id;
	
	/** int */
	public $group_id;
	
	/** string */
	public $display_name;
	
	/** string */
	public $login_name;
	
	/** string */
	public $email;
}

?>