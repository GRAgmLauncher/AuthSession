<?php

namespace Framework\Helpers\Form;

class FormFieldFactory
{
	public function make($which) {
		switch($which) {
			case 'text':
				return $this->makeTextField();
				break;
			case 'upload':
				return $this->makeUploadField();
				break;
			default:
				return $this->makeTextField();
				break;
		}
	}
	
	protected function makeTextField() {
		return new \Framework\Helpers\Form\TextField;
	}
	
	protected function makeUploadField() {
		return new \Framework\Helpers\Form\UploadField;
	}
}