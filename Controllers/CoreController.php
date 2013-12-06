<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Controllers;

class CoreController
{
	protected $App;
	public function __construct($App) {
		$this->App = $App;
	}
	
	public function __get($key) {
		return $this->App[$key];
	}
	
	public function render($view) {
		$this->Template->assign('CurrentUser', $this->CurrentUser);
		$this->Template->assign('Flash', $this->Flash->getMessage());
		$this->Template->assign('CSRFToken', $this->CSRFManager->makeToken());
		$this->Template->render($view);
	}
}

?>