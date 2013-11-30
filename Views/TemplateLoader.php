<?php

namespace Views;

class TemplateLoader
{
	private $vars;
	private $view;
	private $Template;
	
	public function setTemplate(\Views\Template $Template) {
		$this->Template = $Template;
	}
	
	public function set($key, $value) {
		$this->vars[$key] = $value;
	}
	
	public function setView($view) {
		$this->view = $view;
	}
	
	public function render($view) {
		
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