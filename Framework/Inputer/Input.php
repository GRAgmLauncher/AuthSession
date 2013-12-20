<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Inputer;

class Input extends \ArrayObject
{
	public function offsetGet($offset) {
	
		if (!$value = $this->getPost($offset)) {
			$value = $this->getGet($offset);
		}
		return $this->strictClean($value);
    }
	
	protected function getPost($key) {
		if (isset($_POST[$key])) {
			return $_POST[$key];
		}
		return null;
	}
	
	protected function getGet($key) {
		if (isset($_GET[$key])) {
			return $_GET[$key];
		}
		return null;
	}
	
	protected function strictClean($value) {
	
		$value = trim($value);
		$value = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
		$value = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH);
		$value = str_replace("`", "&#96;", $value );
		
		return $value;
	}
}

?>