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
	
		$Products = $this->ProductMapper->fetchAll();
	}
	
	public function details() {
		$this->Template->assign('id', $this->Params['id']);
	}
	
	public function add() {
		
		$sizeOptions = array(null=>'Select a size...', '24x36'=>'24x36', '48x36'=>'48x36');
	
		$this->FormHelper->textField('title', 'Add title...')			->rules('required');
		$this->FormHelper->textField('description', 'Description...')	->rules('required');
		$this->FormHelper->selectField('dimensions', $sizeOptions) 		->rules('required');
		$this->FormHelper->uploadField('image')							->rules('required');
	
		if ($this->Input['submit']) 
		{
			if ($this->FormHelper->validate()) 
			{	
				try {
					$Image = $this->ImageUploader->upload('image', null, UPLOADS.'/product_images/originals');
					$Thumb1 = $Image->saveCopy(null, UPLOADS.'/product_images/thumbs/small', 150, 150, 85);
					$Thumb2 = $Image->saveCopy(null, UPLOADS.'/product_images/thumbs/large', 300, 300, 85);
					
					$Product = $this->ProductFactory->make($this->Input);
					$this->ProductMapper->save($Product);
					
					$Image->rename($Product->id);
					$Thumb1->rename($Product->id);
					$Thumb2->rename($Product->id);
					
					$this->Redirect->to('/products');
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