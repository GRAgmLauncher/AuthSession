<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Interfaces;

interface FlashStorageInterface
{
	public function store(\Framework\Flasher\FlashMessage $FlashMessage);
	public function retrieve();
}

?>