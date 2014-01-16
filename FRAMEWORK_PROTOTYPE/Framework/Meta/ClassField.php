<?php

namespace Framework\Meta;

class ClassField 
{
	public $name;
	public $type;

	public function __construct(\ReflectionProperty $property) {
		$this->name = $property->getName();
		$this->type = $this->getType($property);
		$this->metaType = $this->getMetaType($this->type);
	}
	
	protected function getType($property) {
		$type = substr($property->getDocComment(), 3, -2);
		if (!preg_match('#\*#', $type)) {
				return trim($type);
		}
	}
	
	protected function getMetaType($type) {
		if (in_array($type, array('int', 'string', 'bool', 'float'))) {
			return 'scalar';
		}
		
		return 'object';
	}
}
?>