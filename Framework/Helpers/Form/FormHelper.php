<?php

namespace Framework\Helpers\Form;

class FormHelper
{
	protected $FormFieldFactory;
	protected $Validator;
	private $fields = array();
	private $errors;
	
	public function __construct(\Framework\Helpers\Form\FormFieldFactory $FormFieldFactory, \Framework\Helpers\Form\FormFieldValidator $Validator) {
		$this->FormFieldFactory = $FormFieldFactory;
		$this->Validator = $Validator;
		$this->errors = false;
	}
	
	public function textField($name, $placeholder, $classes = null, $id = null) {
		$Field = $this->FormFieldFactory->make('text');
		$Field->name = $name;
		$Field->placeholder = $placeholder;
		$Field->classes = $classes;
		$Field->id = $id;
		
		$this->addField($Field);
		
		return $Field;
	}
	
	public function uploadField($name, $classes = null, $id = null) {
		$Field = $this->FormFieldFactory->make('upload');
		$Field->name = $name;
		$Field->classes = $classes;
		$Field->id = $id;
		
		$this->addField($Field);
		
		return $Field;
	}
	
	public function showField($name) {
		$html = '';
		$html .= $this->fields[$name]->html();
		$html .= $this->fields[$name]->error();
		
		return $html;
	}
	
	public function setFieldError($fieldName, $errorMessage) {
		$this->fields[$fieldName]->error = $errorMessage;
	}
	
	public function validate() {
		$this->Validator->validateFields($this->fields);
		if ($this->Validator->errors) {
			return false;
		}
		return true;
	}
	
	protected function addField(\Framework\Helpers\Form\FormField $Field) {
		$this->fields[$Field->name] = $Field;
	}
}