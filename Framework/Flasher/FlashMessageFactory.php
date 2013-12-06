<?php

namespace Framework\Flasher;

class FlashMessageFactory
{
	public function make($message, $color) {
		return new \Framework\Flasher\FlashMessage($message, $color);
	}
}


?>