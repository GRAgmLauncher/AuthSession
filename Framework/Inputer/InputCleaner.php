<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Inputer;

class InputCleaner
{
	public $Factory;
	
	public function __construct(\Framework\Inputer\InputFactory $Factory) {
		$this->Factory = $Factory;
	}
	
	public function scrub() {
		$Input = $this->Factory->make();
		foreach ($_POST as $key => $value) {
			$Input[$key] = $value;
		}
		
		foreach ($_GET as $key => $value) {
			$Input[$key] = $value;
		}
		
		return $Input;
	}
}

?>