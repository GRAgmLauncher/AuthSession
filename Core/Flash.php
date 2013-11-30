<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Core;

class Flash
{
	public function __construct() {
		if (!isset($_SESSION['flashMsg'])) {
			$_SESSION['flashMsg'] = null;
		}
		
		$_SESSION['flashColor'] = 'green';
	}
	
	public function set($msg, $color = null) {
		if ($color) {
			$_SESSION['flashColor'] = $color;
		}
		$_SESSION['flashMsg'] = $msg;
	}
	
	public function message() {
		$data = null;
		if (!is_null($_SESSION['flashMsg'])) {
			$data = $_SESSION['flashMsg'];
		}
		$this->clear();
		return $data;
	}
	
	public function color() {
		$_SESSION['flashColor'];
	}
	
	private function clear() {
		unset($_SESSION['flashMsg']);
		unset($_SESSION['flashColor']);
	}
}

?>