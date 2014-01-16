<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2014
 */

namespace Framework;

class Loader 
{
	protected $Mapper;
	protected $Injector;
	
	public function __construct(\Framework\Mapper $Mapper, \Framework\AutoInjector $Injector)
	{
		$this->Injector = $Injector;
		$this->Mapper = $Mapper;
	}
	
	public function find($class, $field, $values) 
	{
		$objects = $this->Mapper->find($class)->where($field)->in($values);
		debug($objects);
		$dependencies = $this->getDependencies($class);

		if (empty($dependencies)) {
			return;
		}
		foreach ($dependencies as $dependency)
		{
			$this->queryChild($class, $dependency, $field, $this->getKeys($objects));
		}
	}
	
	protected function queryChild($parent, $child, $field, $values) {
		
		$children = $this->Mapper->findChild($parent, $child)->where($field)->in($values);
		debug($children);
		$dependencies = $this->getDependencies($child);
		if (empty($dependencies)) {
			return;
		}
		
		foreach ($dependencies as $dependency)
		{
			$this->queryChild($child, $dependency, $field, $this->getKeys($children));
		}
	}
	
	protected function getDependencies($class) {
		
		$metadata = new \Framework\Meta\MetaClass($class);
		
		$dependencies = array();
		
		if (empty($metadata->objectFields)) {
			return;
		}
		
		foreach ($metadata->objectFields as $objectField) {
			$dependencies[] = $objectField->type;
		}
		
		return $dependencies;
	}
	
	protected function getKeys($objects) {
		$keys = array();
		foreach ($objects as $object) {
			$keys[] = $object->id;
		}

		return array_unique($keys);
	}
}
?>