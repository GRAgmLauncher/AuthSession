<?php

namespace Framework;

class Request {
	
	public function getURI() {
		return $_SERVER['REDIRECT_URL'];
	}
	
	public function isPost() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			return true;
		}
		return false;
	}
}


?>