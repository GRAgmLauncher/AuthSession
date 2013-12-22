<?php

namespace Framework\Helpers\Form\Rules;

class Int implements \Framework\Interfaces\FormRuleInterface {
	
	protected $error = 'Field must be an integer';
	
	public function check(\Framework\Helpers\Form\Fields\FormField $Field) {
	
		if (!filter_var($Field->value, FILTER_VALIDATE_INT)) {
			$Field->error = $this->error;
		}
	}
}