<?php

namespace Config;

class SizePrices extends \ArrayObject
{
	public function __construct() {
		$this['48x36'] = 129.99;
	 	$this['24x36'] = 79.99;
	}
}