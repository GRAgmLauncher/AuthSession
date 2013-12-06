<?php

namespace Framework\Security;

class SecurityHelper
{
	public function randomString($length = 16) {
	    $characterSet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    $string = '';
	    for ($i=0; $i<$length; $i++) {
	        $string .= $characterSet[mt_rand(0, strlen($characterSet) - 1)];
	    }
	    return $string;
	}
}

?>