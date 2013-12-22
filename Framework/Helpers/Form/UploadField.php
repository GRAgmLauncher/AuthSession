<?php

namespace Framework\Helpers\Form;

class UploadField extends FormField
{
	public function html() {
		return "<input type=\"file\" classes=\"{$this->classes}\" id=\"{$this->id}\" name=\"{$this->name}\" />";
	}
}