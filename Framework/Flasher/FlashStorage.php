<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Flasher;

class FlashStorage implements \Framework\Interfaces\FlashStorageInterface
{
	public function __construct() {
		if (!isset($_SESSION['FlashMessage'])) {
			$_SESSION['FlashMessage'] = null;
		}
	}
	
	public function store(\Framework\Flasher\FlashMessage $FlashMessage) {
		$_SESSION['FlashMessage'] = $FlashMessage;
	}
	
	public function retrieve() {
		$msg = $_SESSION['FlashMessage'];
		unset($_SESSION['FlashMessage']);
		return $msg;
	}
}

?>