<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Security;

class CSRFToken {
	
	public $key;
	public $value;
	
	public function __construct($key, $value) {
		$this->key = $key;
		$this->value = $value;
	}
}

?>