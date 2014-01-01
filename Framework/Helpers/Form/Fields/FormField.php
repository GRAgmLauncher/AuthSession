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
	
	abstract public function html();
}