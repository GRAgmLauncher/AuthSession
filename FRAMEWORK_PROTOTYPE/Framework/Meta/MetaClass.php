<?php

namespace Framework\Meta;

class MetaClass
{
	public $shortName;
	public $fullName;
	public $namespace;
	public $table;
	public $fields;
	public $scalarFields;
	public $objectFields;
	public $dependencies;
	
	protected $reflector;
	
	public function __construct($object) {
		$this->reflector = new \ReflectionClass($object);
		$this->shortName = $this->reflector->getShortName();
		$this->fullName = $this->reflector->getName();
		$this->namespace = $this->reflector->getNamespaceName();
		$this->table = strtolower($this->shortName);
		$this->parseFields();
	}
	
	public function getField($key) {
		if (isset($this->fields[$key]))
		{
			return $this->fields[$key];
		}
		
		return null;
	}
	
	public function getScalarFieldsAsString() {
		$hack53 = $this;
		return implode(',', array_map(function($key) use ($hack53) {
			return $hack53->table.'.'.$key;
		}, array_keys($this->scalarFields)));
	}
	
	private function createDependencies() {
		if (!empty($this->objectFields)) {
			foreach ($this->objectFields as $key => $Field) {
				$this->dependencies[$Field->name] = new MetaClass($Field->type);
			}
		}
	}
	
	private function parseFields() {
		foreach ($this->reflector->getProperties() as $field) {
			$metaField = new \Framework\Meta\ClassField($field);
			$this->addField($metaField);
			
			if ($metaField->metaType == 'scalar') {
				$this->addScalarField($metaField);
			}
			
			if ($metaField->metaType == 'object') {
				$this->addObjectField($metaField);
			}
		}
	}
	
	private function addField(\Framework\Meta\ClassField $field) {
		$this->fields[$field->name] = $field;
	}
	
	private function addScalarField(\Framework\Meta\ClassField $field) {
		$this->scalarFields[$field->name] = $field;
	}
	
	private function addObjectField(\Framework\Meta\ClassField $field) {
		$this->objectFields[$field->name] = $field;
	}
}

?>