<?php

namespace Models\Product;

class ProductImagesMapper {

	protected $ProductImages;
	protected $ImageFactory;

	public function __construct(\Models\Product\ProductImages $ProductImages, \Framework\Image\ImageFactory $ImageFactory) {
		$this->ProductImages = $ProductImages;
		$this->ImageFactory = $ImageFactory;
	}
	
	public function fetchProductImages($productID) {
		$this->ProductImages->original = $this->ImageFactory->make(UPLOADS.'/product_images/originals/'.$productID.'.jpg');
		$this->ProductImages->largeThumb = $this->ImageFactory->make(UPLOADS.'/product_images/thumbs/large/'.$productID.'.jpg');
		$this->ProductImages->smallThumb = $this->ImageFactory->make(UPLOADS.'/product_images/thumbs/small/'.$productID.'.jpg');
		
		return $this->ProductImages;
	}

}