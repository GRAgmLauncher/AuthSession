<?php

namespace Framework\Helpers\Form\Fields;

class Password extends FormField
{
	public $placeholder;
	
	public function html() {
		return "<input type=\"password\" class=\"{$this->classes}\" id=\"{$this->id}\" name=\"{$this->name}\" placeholder=\"{$this->placeholder}\" />";
	}
}