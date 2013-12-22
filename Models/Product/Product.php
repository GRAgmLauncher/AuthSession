<?php

namespace Models\Product;

class Product
{
	/** int */
	public $id;
	
	/** string */
	public $dimensions;
	
	/** string */
	public $title;
	
	/** string */
	public $description;
	
	/** int */
	public $inventory;
	
	/** float */
	public $price;
	
	/** \Models\Product\ProductImages */
	public $images;
	
	public function getSlugName() {
		return strtolower(str_replace(' ', '-', trim($this->title)));
	}
}