<?php

namespace Framework\Helpers\Tabs;

class Tab {
	
	public $name;
	public $link;
	public $classes;
	public $active;
	
	public function __construct($name, $link, $classes) {
		$this->name = $name;
		$this->link = $link;
		$this->classes = $this->addClass($classes);
		$this->setActive(false);
	}
	
	public function addClass($class) {
		if ($this->classes) {
			$this->classes .= " $class";
		} else {
			$this->classes = $class;
		}
	}
	
	public function setActive($bool) {
		$this->active = $bool;
	}
	
	public function html() {
		if ($this->active) {
			$this->addClass('active');
		}
		
		return "<li class=\"{$this->classes}\"><a href=\"{$this->link}\">{$this->name}</a></li>";
	}
}