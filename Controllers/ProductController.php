<?php

namespace Controllers;

class ProductController extends \Controllers\CoreController
{
	protected $ProductFactory;
	protected $ProductMapper;
	protected $ImageUploader;
	protected $FormHelper;
	
	public function __construct
	(
		\Models\Product\ProductFactory $ProductFactory, 
		\Models\Product\ProductMapper $ProductMapper,
		\Framework\Image\ImageUploader $ImageUploader,
		\Framework\Helpers\Form\FormHelper $FormHelper
	) 
	{
		$this->ProductFactory = $ProductFactory;
		$this->ProductMapper = $ProductMapper;
		$this->ImageUploader = $ImageUploader;
		$this->FormHelper = $FormHelper;
	}
	
	public function index() {
		
	}
	
	public function details() {
		$this->Template->assign('id', $this->Params['id']);
	}
	
	public function add() {
	
		$this->FormHelper->textField('title', 'Add title...')			->rules('required');
		$this->FormHelper->textField('description', 'Description...')	->rules('required');
		$this->FormHelper->uploadField('image');
	
		if ($this->Input['submit']) 
		{
			if ($this->FormHelper->validate()) 
			{	
				try {
					$tempname = 'adlksfajsdflafd';
					
					$Image = $this->ImageUploader->upload('image', $tempname, UPLOADS.'/product_images/originals');
					$Thumb1 = $Image->saveCopy($tempname, UPLOADS.'/product_images/thumbs/small', 150, 150);
					$Thumb2 = $Image->saveCopy($tempname, UPLOADS.'/product_images/thumbs/large', 300, 300);
					
					$Product = $this->ProductFactory->make();
					$Product->populateFromSource($this->Input);
					$this->ProductMapper->save($Product);
					
					$Image->rename($Product->id);
					$Thumb1->rename($Product->id);
					$Thumb2->rename($Product->id);
				} 
				catch(\Exception $e) {
					$this->FormHelper->setFieldError('image', $e->getMessage());
				}

			}
		}
		
		$this->Template->assign('Form', $this->FormHelper);
	}
	
	public function edit() {
		
	}
	
	public function delete() {
		
	}
}