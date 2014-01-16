<?php

namespace Framework\Meta;

class DependencyField
{
	public $identifierField;
	public $objectField;

	public function __construct(\Framework\Meta\ClassField $identifierField, \Framework\Meta\ClassField $objectField) {
		$this->identifierField = $identifierField;
		$this->objectField = $objectField;
	}
}
?>