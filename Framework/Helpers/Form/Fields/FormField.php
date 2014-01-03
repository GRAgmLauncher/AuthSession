<?php

namespace Framework\Helpers\Form\Fields;

abstract class FormField
{
	public $name;
	public $upperName;
	public $classes;
	public $id;
	public $rules;
	public $error;
	public $value;
	
	public function rules($rules) {
		$this->rules = $rules;
		return $this;
	}
	
	public function error() {
		if ($this->error) {
			return $this->error;
		}
	}
	
	public function addClass($class) {
		if ($this->classes){
			$this->classes .= " $class";
		}
		else{
			$this->classes .= "$class";
		}
	}
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	abstract public function html();
}