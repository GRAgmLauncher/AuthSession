<?php

namespace Models\Product;

class ProductFactory 
{
	public function make() {
		return new \Models\Product\Product;
	}
}