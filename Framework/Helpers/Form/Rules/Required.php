<?php

namespace Framework\Helpers\Form\Rules;

class Required implements \Framework\Interfaces\FormRuleInterface {
	
	protected $error = 'This field is required';
	
	public function check(\Framework\Helpers\Form\Fields\FormField $Field) {
		if (!$Field->value) {
			$Field->error = $this->error;
		}
		
		if ($Field instanceof \Framework\Helpers\Form\Fields\Upload) {
			if (!isset($_FILES[$Field->name]) || $_FILES[$Field->name]['error'] == 4) {
				$Field->error = $this->error;
			}
		}
	}
}