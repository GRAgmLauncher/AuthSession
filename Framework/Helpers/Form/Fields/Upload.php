<?php

namespace Framework\Helpers\Form\Fields;

class Upload extends FormField
{
	public function html() {
		return "<input type=\"file\" class=\"{$this->classes}\" id=\"{$this->id}\" name=\"{$this->name}\" />";
	}
}