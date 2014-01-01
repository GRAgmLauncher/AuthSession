<?php

namespace Framework\Helpers\Form\Fields;

class Text extends FormField
{
	public $placeholder;
	
	public function html() {
		return "<input type=\"text\" class=\"{$this->classes}\" id=\"{$this->id}\" name=\"{$this->name}\" value=\"{$this->value}\" placeholder=\"{$this->placeholder}\" />";
	}
}