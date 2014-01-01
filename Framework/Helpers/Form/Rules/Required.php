<?php

namespace Framework\Helpers\Form\Rules;

class Required implements \Framework\Interfaces\FormRuleInterface {

	public function check(\Framework\Helpers\Form\Fields\FormField $Field) {
		$error = "{$Field->upperName} is required";
		if (!$Field->value) {
			$Field->error = $error;
		}
		
		if ($Field instanceof \Framework\Helpers\Form\Fields\Upload) {
			$Field->error = null;
			if (!isset($_FILES[$Field->name]) || $_FILES[$Field->name]['error'] == 4) {
				$Field->error = $error;
			}
		}
	}
}