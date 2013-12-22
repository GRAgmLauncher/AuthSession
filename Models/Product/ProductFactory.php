<?php

namespace Models\Product;

class ProductFactory 
{
	public function make($data) {
		$Product = new \Models\Product\Product;
		$this->populate($Product, $data);
		return $Product;
	}
	
	protected function populate($Product, $data) {
		$reflector = new \ReflectionClass($Product);
		foreach($reflector->getProperties() as $field) {
			$fieldName = $field->getName();
			$Product->$fieldName = $data[$fieldName];
		}
	}
}