<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Controllers;

class SecurityTestController extends \Controllers\CoreController
{
	public function test() {
		if ($this->Input['submit']) {
			debug($this->Input['hackme']);
		}
	}
}

?>