<?php

namespace Views;

class Template
{
	private $vars;
	private $view;
	
	public function assign($key, $value) {
		$this->vars[$key] = $value;
	}
	
	public function setView($view) {
		$this->view = $view;
	}
	
	public function render($view = null) {
		
		if (!$this->view) {
			$this->setView($view);
		}
		
		extract($this->vars);
		
		require_once("/Views/common/header.php");
		require_once("/Views/{$this->view}.php");
		require_once("/Views/common/footer.php");
	}
}

?>