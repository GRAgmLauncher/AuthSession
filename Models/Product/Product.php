<?php

namespace Models\Product;

class Product
{
	/** int */
	public $id;
	
	/** int */
	public $width;
	
	/** int */
	public $height;
	
	/** string */
	public $title;
	
	/** string */
	public $description;
	
	/** int */
	public $inventory;
	
	/** float */
	public $price;
	
	public function getSlugName() {
		return strtolower(str_replace(' ', '-', trim($this->title)));
	}
	
	public function populateFromSource($source) {
		foreach($this->getFields() as $field) {
			$this->$field = $source[$field];
		}
	}
	
	protected function getFields() {
		$fields = array();
		$reflector = new \ReflectionClass($this);
		
		foreach($reflector->getProperties() as $field) {
			$fields[] = $field->getName();
		}
		
		return $fields;
	}
}