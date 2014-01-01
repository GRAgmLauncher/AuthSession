<?php

namespace Controllers;

class PaintingController extends \Controllers\CoreController
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
	
	public function indexAll() {
		$Products = $this->ProductMapper->fetchAll();
		$this->Template->assign('Paintings', $Products);
		$this->Template->setView('painting/index');
	}
	
	public function indexSize() {
		$size = $this->Params['size'];
		$Products = $this->ProductMapper->fetchAllWhere('dimensions', $size);
		$this->Template->assign('Paintings', $Products);
		$this->Template->setView('painting/index');
	}
	
	public function details() {
		if (!$Product = $this->ProductMapper->fetchById($this->Params['id'])) {
			$this->Redirect->to('/404');
		}
		$this->ProductMapper->save($Product);
		$this->Template->assign('Product', $Product);
	}
}