<?php

namespace Framework\Helpers\Form;

class FormFieldValidator
{
	protected $Input;
	public $errors;
	
	public function __construct(\Framework\Inputer\Input $Input) {
		$this->Input = $Input;
		$this->errors = false;
	}
	
	public function validateFields($fields) 
	{
		foreach($fields as $fieldName => $Field) 
		{
			$this->validateField($Field);
			
			if (!$Field->error) {
				$Field->value = $this->Input[$fieldName];
			}
			else {
				$this->errors = true;
			}
		}
	}
	
	public function validateField($Field) {
		if (!$Field->rules) {
			return;
		}
		
		foreach($this->getRules($Field->rules) as $ruleName) {
			$this->$ruleName($Field);
		}
	}
	
	protected function getRules($flags) {
		$rules = array();
		$flags = explode('|', $flags);
		
		foreach ($flags as $flag) {
			$rules[] = 'rule'.ucfirst($flag);
		}
		
		return $rules;
	}
	
	protected function ruleRequired($Field) {
		if (!$this->Input[$Field->name]) {
			$Field->error = 'This field is required';
		}
		
		if ($Field instanceof \Framework\Helpers\Form\UploadField) {
			if (!isset($_FILES[$Field->name]) || $_FILES[$Field->name]['error'] == 4) {
				$Field->error = 'This field is required';
			}
		}
	}
}