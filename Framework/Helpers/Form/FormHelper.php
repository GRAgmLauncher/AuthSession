<?php

namespace Framework\Helpers\Form;

class FormHelper
{
	protected $FormFieldFactory;
	protected $Validator;
	protected $Request;
	private $fields = array();
	private $errors;
	
	public function __construct(\Framework\Helpers\Form\FormFieldFactory $FormFieldFactory, \Framework\Helpers\Form\FormFieldValidator $Validator, \Framework\Request $Request) {
		$this->FormFieldFactory = $FormFieldFactory;
		$this->Validator = $Validator;
		$this->Request = $Request;
		$this->errors = false;
	}
	
	public function textField($name, $placeholder, $classes = null, $id = null) {
		$data = compact('name', 'placeholder', 'classes', 'id');
		$Field = $this->FormFieldFactory->make('text', $data);
		$this->addField($Field);
		
		return $Field;
	}
	
	public function uploadField($name, $classes = null, $id = null) {
		$data = compact('name', 'classes', 'id');
		$Field = $this->FormFieldFactory->make('upload', $data);		
		$this->addField($Field);
		
		return $Field;
	}
	
	public function selectField($name, $options, $classes = null, $id = null) {
		$data = compact('name', 'options', 'classes', 'id');
		$Field = $this->FormFieldFactory->make('select', $data);
		$this->addField($Field);
		
		return $Field;
	}
	
	public function passwordField($name, $placeholder, $classes = null, $id = null) {
		$data = compact('name', 'placeholder', 'classes', 'id');
		$Field = $this->FormFieldFactory->make('password', $data);
		$this->addField($Field);
		
		return $Field;
	}
	
	public function hiddenField($name, $initialValue = null) {
		$data = compact('name', 'initialValue');
		$Field = $this->FormFieldFactory->make('password', $data);
		$this->addField($Field);
		
		return $Field;
	}
	
	public function submitField($name='submit', $value="Submit", $classes = null, $id = null) {
		$data = compact('name', 'value', 'classes', 'id');
		$Field = $this->FormFieldFactory->make('submit', $data);
		$this->addField($Field);
		
		return $Field;
	}
	
	public function field($name) {
		$Field = $this->fields[$name];
		if ($Field->error()) {
			$Field->placeholder = $Field->error();
		}
		$html = '';
		$html .= $this->fields[$name]->html();
		
		return $html;
	}
	
	public function setFieldError($fieldName, $errorMessage) {
		$this->fields[$fieldName]->value = null;
		$this->fields[$fieldName]->error = $errorMessage;
		$this->fields[$fieldName]->placeholder = $errorMessage;
		$this->fields[$fieldName]->addClass('error');
	}
	
	public function validate() {
		if (!$this->Request->isPost()) {
			return false;
		}
		
		$this->Validator->validateFields($this->fields);
		if ($this->Validator->errors) {
			return false;
		}
		return true;
	}
	
	protected function addField(\Framework\Helpers\Form\Fields\FormField $Field) {
		$this->fields[$Field->name] = $Field;
	}
}