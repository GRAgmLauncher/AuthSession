<?php

namespace Models\Product;

class PriceManager 
{
	protected $SizePrices;
	
	public function __construct(\Config\SizePrices $SizePrices) {
		$this->SizePrices = $SizePrices;
	}
	
	public function getPriceBySize($paintingSize) {
		return $this->SizePrices[$paintingSize];
	}
}