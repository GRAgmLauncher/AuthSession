<?php

namespace Framework\Helpers\Form\Fields;

class Hidden extends FormField
{
	public function html() {
		return "<input type=\"hidden\" name=\"{$this->name}\" value=\"{$this->value}\" />";
	}
}