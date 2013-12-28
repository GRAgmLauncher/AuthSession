<?php

namespace Framework\ORM;

class RelationTree 
{
	public $objects_to_query = array();
	
	public function findChild($object) {
	
		$reflection = new \ReflectionClass($object);
		foreach ($reflection->getProperties() as $property) {
			$field = new \Framework\DataFieldReflector($property);
			$fieldType = $field->getType();
			if (!in_array($fieldType, array('string', 'int', 'float', 'bool'))) {
				$this->objects_to_query[$object] = $fieldType;
				$this->findChild($fieldType);
			}
		}
	}
}