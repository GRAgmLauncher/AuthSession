<?php

namespace Framework;

class Request {
	
	public function getURI() {
		return $_SERVER['REDIRECT_URL'];
	}
}


?>