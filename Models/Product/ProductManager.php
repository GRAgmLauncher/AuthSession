<?php

namespace Models\Product;

class ProductManager
{
	protected $ProductFactory;
	protected $ProductMapper;
	
	public function __construct
	(
		\Models\Product\ProductFactory $ProductFactory,
		\Models\Product\ProductMapper $ProductMapper
	)
	{
		$this->ProductFactory = $ProductFactory;
		$this->ProductMapper = $ProductMapper;
	}
	
	public function createProductFromSource($source) {
		$Product = $this->ProductFactory->make();
		foreach($this->getProductFields($Product) as $field) {
			$Product->$field = $source[$field];
		}
		
		return $this->ProductMapper->save($Product);
	}
	
	protected function getProductFields($Product) {
		$fields = array();
		$reflector = new \ReflectionClass($Product);
		
		foreach($reflector->getFields() as $field) {
			$fields[] = $field->getName();
		}
		
		return $fields;
	}
}