<?php

namespace Models\Blog;

class Blog 
{
	/** int */
	public $id;
	
	/** string */
	public $title;
	
	/** \Models\User\User */
	public $User;
	
	public function __construct(\Models\User\User $User) {
		$this->User = $User;
	}
}


?>