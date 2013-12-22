<?php

namespace Framework\Helpers\Form;

class FormRuleFactory
{
	public function make($ruleName) {
		$ruleName = strtolower($ruleName);
		$ruleName = ucfirst($ruleName);
		$rule = "\Framework\Helpers\Form\Rules\\".$ruleName;
		return new $rule;
	}
}