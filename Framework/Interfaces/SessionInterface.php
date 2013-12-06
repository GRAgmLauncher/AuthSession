<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Interfaces;

interface SessionInterface
{
	public function populate(\Models\User\User $User = null);
	public function updateTimestamp();
	public function regenerateID();
}

?>