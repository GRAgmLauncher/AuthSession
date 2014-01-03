<?php

namespace Controllers;

class ManageProductsController extends \Controllers\CoreController
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
		$this->PermLevel->atLeast(10);
		$Products = $this->ProductMapper->fetchAll();
		$this->Template->assign('Products', $Products);
	}
	
	public function details() {
		$this->PermLevel->atLeast(10);
		$this->Template->assign('id', $this->Params['id']);
	}
	
	public function add() {
		$this->PermLevel->atLeast(10);
		$sizeOptions = array(null=>'Select a size...', '24x36'=>'24x36', '48x36'=>'48x36');
	
		$this->FormHelper->textField('title', 'Add title...')			->rules('required');
		$this->FormHelper->textField('description', 'Description...')	->rules('required');
		$this->FormHelper->selectField('dimensions', $sizeOptions) 		->rules('required');
		$this->FormHelper->uploadField('image')							->rules('required');
		$this->FormHelper->submitField('submit', 'Add Painting');
		
		if ($this->Input['submit']) 
		{
			if ($this->FormHelper->validate()) 
			{	
				try {
					$Image = $this->ImageUploader->upload('image', null, UPLOADS.'/originals');
					$Thumb1 = $Image->saveCopy(null, UPLOADS.'/thumbs/small', 150, 150, 85);
					$Thumb2 = $Image->saveCopy(null, UPLOADS.'/thumbs/large', 300, 300, 85);
					
					$Product = $this->ProductFactory->make($this->Input);
					$this->ProductMapper->save($Product);
					
					$Image->rename($Product->id);
					$Thumb1->rename($Product->id);
					$Thumb2->rename($Product->id);
					
					$this->Redirect->to('/manage/paintings');
				} 
				catch(\Exception $e) {
					$this->FormHelper->setFieldError('image', $e->getMessage());
				}
			}
		}
		
		$this->Template->assign('Form', $this->FormHelper);
	}
	
	public function edit() {
		$this->PermLevel->atLeast(10);
		$sizeOptions = array(null=>'Select a size...', '24x36'=>'24x36', '48x36'=>'48x36');
	
		$id = $this->Params['id'];
		$Product = $this->ProductMapper->fetchByID($id);
	
		$this->FormHelper->textField('title', 'Add title...')			->rules('required')->setValue($Product->title);
		$this->FormHelper->textField('description', 'Description...')	->rules('required')->setValue($Product->description);
		$this->FormHelper->selectField('dimensions', $sizeOptions) 		->rules('required')->setValue($Product->dimensions);
		$this->FormHelper->uploadField('image')							->rules('required');
		$this->FormHelper->submitField('submit', 'Add Painting');
		
		$this->Template->assign('Form', $this->FormHelper);
	}
	
	public function delete() {
		
	}
}