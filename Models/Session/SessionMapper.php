<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Models\Session;

class SessionMapper extends \Core\MapperObject
{
	protected $table = 'session';
	protected $fields = array
	(
		'id'			=> 'string',
		'group_id'		=> 'int',
		'user_id'		=> 'int',
		'time_stamp'	=> 'int'
	);
}

?>