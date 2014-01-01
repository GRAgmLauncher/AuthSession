<?php

namespace Framework\Helpers\Tabs;

class TabFactory {
	
	public function make($name, $link, $classes) {
		return new \Framework\Helpers\Tabs\Tab($name, $link, $classes);
	}
}