<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Inputer;

class InputFactory
{
	public function make() {
		return new \Framework\Inputer\Input;
    }
}

?>