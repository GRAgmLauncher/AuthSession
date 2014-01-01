<?php

namespace Models\Product;

class ProductImagesMapper {

	protected $ProductImageCollectionPrototype;
	protected $ImageFactory;

	public function __construct(\Models\Product\ProductImageCollection $ProductImageCollection, \Framework\Image\ImageFactory $ImageFactory) {
		$this->ProductImageCollectionPrototype = $ProductImageCollection;
		$this->ImageFactory = $ImageFactory;
	}
	
	public function fetchProductImages($productID) {
		$ProductImageCollection = clone $this->ProductImageCollectionPrototype;
		$ProductImageCollection->original = $this->ImageFactory->make(UPLOADS.'/originals/'.$productID.'.jpg');
		$ProductImageCollection->large = $this->ImageFactory->make(UPLOADS.'/thumbs/large/'.$productID.'.jpg');
		$ProductImageCollection->small = $this->ImageFactory->make(UPLOADS.'/thumbs/small/'.$productID.'.jpg');
		
		return $ProductImageCollection;
	}

}