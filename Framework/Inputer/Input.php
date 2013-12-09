<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Inputer;

class Input extends \ArrayObject
{
	public function offsetGet($offset) {
		return ($this->offsetExists($offset)) ? parent::offsetGet($offset) : null;
    }
}

?>