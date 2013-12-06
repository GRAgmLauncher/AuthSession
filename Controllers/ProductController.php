<?php

namespace Controllers;

class ProductController extends \Controllers\CoreController
{
	public function index() {
		
	}
	
	public function details() {
		$this->Template->assign('id', $this->Params['id']);
	}
	
	public function add() {
		
	}
	
	public function edit() {
		
	}
	
	public function delete() {
		
	}
}