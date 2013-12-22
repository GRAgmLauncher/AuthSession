<?php

namespace Framework\Helpers\Form;

class FormFieldFactory
{
	public function make($fieldType, $data) {
		$fieldType = strtolower($fieldType);
		$fieldType = ucfirst($fieldType);
		$field = "\Framework\Helpers\Form\Fields\\".$fieldType;
		$Field = new $field;
		$this->populate($Field, $data);
		
		return $Field;
	}
	
	public function populate($Field, $data) {
		foreach($data as $key => $value) {
			$Field->$key = $value;
		}
	}
}