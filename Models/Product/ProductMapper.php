<?php

namespace Models\Product;

class ProductMapper extends \Framework\MapperObject
{
	protected $table = 'product';
	protected $proxy = '\Models\Product\Product';
	protected $ProductImagesMapper;
	
	public function __construct(\PDO $db, \Models\Product\ProductImagesMapper $ProductImagesMapper) {
		parent::__construct($db);
		$this->ProductImagesMapper = $ProductImagesMapper;
	}
	
	public function addChildren(\Models\Product\Product $Product) {
		$Product->images = $this->ProductImagesMapper->fetchProductImages($Product->id);
	}

}