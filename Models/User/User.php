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

	/** string */
	public $display_name;
	
	/** string */
	public $login_name;
	
	/** string */
	public $email;
	
	/** int */
	public $group_id;
	
	/** Group */
	public $Group;
}

?>