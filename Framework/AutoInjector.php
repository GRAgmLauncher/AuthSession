<?php

namespace Framework;

class AutoInjector 
{
	public $substitutions = array();
	public $shared = array();
	public $cache = array();
	public $instances = array();

	/**
	 * Recursively injects an object with all of its required dependencies
	 * @param $className string - the fully qualified namespace & class to create an instance of
	 * @return object
	 */

	public function create($className) {
		
		//-----------------------------------------------------------
		// Check the class name for substitutions
		//-----------------------------------------------------------

		$className = $this->getSubstitution($className);
		
		
		//-----------------------------------------------------------
		// If the class is already cached, return the cached instance
		//-----------------------------------------------------------
		
		if ($this->isCached($className)) {
			return $this->getCache($className);
		}
		
		
		//-----------------------------------------------------------
		// If the class has a specific instance, return that instance
		//-----------------------------------------------------------
		
		if ($this->hasInstance($className)) {
			return $this->getInstance($className);
		}
		
		
		//-----------------------------------------------------------
		// Begin Reflection
		//-----------------------------------------------------------
		
		try {
			$ReflectedClass = new \ReflectionClass($className);
		} catch (\Exception $e) {
			echo "{$className} does not exist";exit;
		}
		
				
		
		
		//-----------------------------------------------------------
		// Get the injections to be passed into the ReflectedClass's constructor arguments
		//-----------------------------------------------------------
		
		$injections = $this->getConstructorInjections($ReflectedClass);

		//-----------------------------------------------------------
		// If injection count is 0, just return a new instance of the given class name
		// If injectin count is greater than 0, create a new instance of the ReflectedClass with the appropriate injected dependencies
		//-----------------------------------------------------------
		
		if (count($injections) == 0) {
			$object = new $className;
		} else {
			$object = $ReflectedClass->newInstanceArgs($injections);
		}
		
		
		//-----------------------------------------------------------
		// Cache the object if it's meant to be shared
		//-----------------------------------------------------------
		
		if ($this->isShared($className)) {
			$this->cacheObject($className, $object);
		}
		
		return $object;
	}
	
		
	public function share($class) {
		$this->shared[] = $this->trimClass($class);
	}
	
	public function substitute($thisClass, $thatClass) {
		$this->substitutions[$this->trimClass($thisClass)] = $thatClass;
	}
	
	public function register($thisClass, $obj) {
		$this->instances[$this->trimClass($thisClass)] = $obj;
	}
	
	/**
	 * Checks for a substitution of the given class (e.g. if an abstract class is being substituted for a concrete class)
	 * @param $className string
	 * @return string
	 */	
	
	private function getSubstitution($className) {
		if (isset($this->substitutions[$className])) {
			return $this->substitutions[$className];
		}
		
		return $className;
	}
	
	private function getConstructorInjections(\ReflectionClass $ReflectedClass)
	{
		$injections = array();
		
		if (!$Constructor = $ReflectedClass->getConstructor()) {
			return $injections;
		}
		
		$params = $this->getConstructorParameters($Constructor);
		if (count($params > 0)) {
			foreach ($params as $param) {
				$injections[] = $this->create($param);
			}
		}
		
		return $injections;
	}
	
	private function getConstructorParameters(\ReflectionMethod $Constructor)
	{
		$parameters = array();
		foreach($Constructor->getParameters() as $param) {
			if ($param->getClass()) {
				$parameters[] = $param->getClass()->name;
			}
		}
		return $parameters;
	}

	
	private function isCached($className) 
	{
		if (isset($this->cache[$this->trimClass($className)])) 
		{
			return true;
		}
		return false;
	}
	
	private function cacheObject($className, $object) 
	{
		$this->cache[$this->trimClass($className)] = $object;
	}
	
	private function getCache($className) 
	{
		return $this->cache[$this->trimClass($className)];
	}
	
	private function isShared($className) 
	{
		if (in_array($this->trimClass($className), $this->shared)) 
		{
			return true;
		}
		return false;
	}
	
	private function hasInstance($className) {
		if (isset($this->instances[$this->trimClass($className)])) 
		{
			return true;
		}
		return false;
	}
	
	private function getInstance($className) {
		return $this->instances[$this->trimClass($className)];
	}
	
	private function trimClass($className) {
		return ltrim($className, '\\');
	}
}