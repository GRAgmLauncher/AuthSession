<?php

namespace Core;

class Request {
	
	public function getURI() {
		return $_SERVER['REQUEST_URI'];
	}
}


?>