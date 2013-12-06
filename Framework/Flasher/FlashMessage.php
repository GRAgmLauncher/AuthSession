<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Flasher;

class FlashMessage
{
	public $message;
	public $color;
	
	public function __construct($message, $color = 'green') {
		$this->message = $message;
		$this->color = $color;
	}
}

?>