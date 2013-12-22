<?php

namespace Models\Product;

class ProductMapper extends \Framework\MapperObject
{
	protected $table = 'product';
	protected $proxy = '\Models\Product\Product';
}