<?php

namespace Framework\Helpers\Tabs;

class TabHelper {
	
	protected $Request;
	protected $TabFactory;
	public $tabs = array();
	
	public function __construct(\Framework\Request $Request, \Framework\Helpers\Tabs\TabFactory $TabFactory) {
		$this->Request = $Request;
		$this->TabFactory = $TabFactory;
	}
	
	public function getTabs() {
		foreach ($this->tabs as $Tab) {
			debug($Tab->link);
			debug($this->Request->getURI());
			if ($Tab->link == $this->Request->getURI()) {
				$Tab->setActive(true);
			}
		}
		
		return $this->tabs;
	}
	
	public function getTab($name) {
		return $this->tabs[$name];
	}
	
	public function tab($name, $link, $classes = null) {
		$Tab = $this->TabFactory->make($name, $link, $classes);
		
		if ($Tab->link == $this->Request->getURI()) {
			$Tab->setActive(true);
		}
		
		return $Tab->html();
	}
	
	protected function addTab(\Framework\Helpers\Tabs\Tab $Tab) {
		$this->tabs[$Tab->name] = $Tab;
	}
}