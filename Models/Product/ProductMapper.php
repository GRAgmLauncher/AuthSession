<?php

namespace Models\Product;

class ProductMapper extends \Framework\MapperObject
{
	protected $table = 'product';
	protected $proxy = '\Models\Product\Product';
	protected $ProductImagesMapper;
	protected $PriceManager;
	
	public function __construct(\PDO $db, \Models\Product\ProductImagesMapper $ProductImagesMapper, \Models\Product\PriceManager $PriceManager) {
		parent::__construct($db);
		$this->ProductImagesMapper = $ProductImagesMapper;
		$this->PriceManager = $PriceManager;
	}
	
	public function addChildren(\Models\Product\Product $Product) {
		$Product->images = $this->ProductImagesMapper->fetchProductImages($Product->id);
		$Product->price = $this->PriceManager->getPriceBySize($Product->dimensions);
	}

}