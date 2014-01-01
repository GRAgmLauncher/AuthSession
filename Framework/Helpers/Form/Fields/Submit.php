<?php

namespace Framework\Helpers\Form\Fields;

class Submit extends FormField
{
	public function html() {
		return "<button type=\"submit\" name=\"{$this->name}\" class=\"{$this->classes}\" value=\"{$this->value}\"/>{$this->value}</button>";
	}
}