<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Controllers;

class DefaultController extends \Controllers\CoreController
{
	public function error404() {
		$this->Template->setView("common/404");
	}
	
	public function welcome() {
		$this->Template->setView("common/welcome");
	}
}

?>