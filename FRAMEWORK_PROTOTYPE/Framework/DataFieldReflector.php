<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework;

class DataFieldReflector
{
	protected $property;
	
	public function __construct(\ReflectionProperty $property) {
		$this->property = $property;
	}
	
	public function getName() {
		return $this->property->getName();
	}
	
	public function getType() {
		$type = substr($this->property->getDocComment(), 3, -2);
		if (!preg_match('#\*#', $type)) {
				return trim($type);
		}
	}
}

?>