<?php

namespace Framework\Interfaces;

interface FormRuleInterface
{
	public function check(\Framework\Helpers\Form\Fields\FormField $Field);
}