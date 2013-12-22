<?php

namespace Framework\Helpers\Form\Fields;

abstract class FormField
{
	public $name;
	public $classes;
	public $id;
	public $rules;
	public $error;
	public $value;
	
	public function rules($rules) {
		$this->rules = $rules;
	}
	
	public function error() {
		if ($this->error) {
			return "<div class=\"fieldError\">{$this->error}</div>";
		}
	}
	
	abstract public function html();
}