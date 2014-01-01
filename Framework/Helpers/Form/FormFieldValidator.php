<?php

namespace Framework\Helpers\Form;

class FormFieldValidator
{
	protected $Input;
	protected $FormRuleFactory;
	public $errors;
	
	public function __construct(\Framework\Inputer\Input $Input, \Framework\Helpers\Form\FormRuleFactory $FormRuleFactory) {
		$this->Input = $Input;
		$this->FormRuleFactory = $FormRuleFactory;
		$this->errors = false;
	}
	
	public function validateFields($fields) {
		foreach($fields as $Field) {
			$Field->value = $this->Input[$Field->name];
			$this->validateField($Field);
		}
	}
	
	public function validateField($Field) {
		if (!$Field->rules) {
			return;
		}
		
		foreach(explode('|', $Field->rules) as $ruleName) {
			$rule = $this->FormRuleFactory->make($ruleName);
			$rule->check($Field);
		}

		if ($Field->error) {
			$Field->addClass('error');
			$Field->value = null;
			$this->errors = true;
		}
	}
}