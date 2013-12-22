<?php

namespace Framework\Helpers\Form;

class TextField extends FormField
{
	public $placeholder;
	public $value;
	
	public function html() {
		return "<input type=\"text\" classes=\"{$this->classes}\" id=\"{$this->id}\" name=\"{$this->name}\" value=\"{$this->value}\" placeholder=\"{$this->placeholder}\" />";
	}
}