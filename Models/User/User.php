<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Models\User;

class User extends \Core\DomainObject implements \Interfaces\UserInterface
{
	public $id;
	public $group_id;
	public $display_name;
	public $login_name;
	public $email;
}

?>