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
	
	public function tab($name, $link, $classes = null) {
		$Tab = $this->TabFactory->make($name, $link, $classes);
		
		if ($Tab->link == $this->Request->getURI()) {
			$Tab->setActive(true);
		}
		
		return $Tab->html();
	}
}