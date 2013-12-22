<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework;

class Redirect
{
	public $Flash;
	public $Request;
	
	public function __construct(\Framework\Flasher\Flash $Flash, \Framework\Request $Request) {
		$this->Flash = $Flash;
		$this->Request = $Request;
	}
	
	public function to($location = null) {
		if (!$location) {
			$location = $this->Request->getURI();
		}
		
		header('Location: '.$location);
		exit();	
	}
	
	public function withMessage($message, $color = null, $location = null) {
		$this->Flash->setMessage($message, $color);
		$this->to($location);	
	}
}

?>