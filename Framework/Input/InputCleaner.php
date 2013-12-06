<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Input;

class InputCleaner
{
	public $Input;
	
	public function __construct(\Framework\Input\Input $Input) {
		$this->Input = $Input;
	}
	
	public function scrub() {
		foreach ($_POST as $key => $value) {
			$this->Input[$key] = $value;
		}
		return $this->Input;
	}
}

?>