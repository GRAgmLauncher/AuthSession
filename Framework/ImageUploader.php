<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework;

class ImageUploader {
	
	protected $directory;
	protected $imageData;
	
	public function __construct($uploadDirectory) {
		$this->directory = $uploadDirectory;
	}
	
	public function upload($field) {
		$image = $_FILES[$field]['tmp_name'];
	 	if ($this->imageData = @getimagesize($image)) {
	 		$path = $this->makePath();
	 		@move_uploaded_file($image, $path);
	 		return $path;
	 	}
	}
	
	protected function getExtension() {
		switch ($this->imageData[2]) {
			case 1:
				$extension = '.gif';
				break;
			case 2: 
				$extension = '.jpg';
				break;
			case 3:
				$extension = '.png';
				break;
		}
		return $extension;
	}
	
	protected function generateRandomName() {
		return str_shuffle(md5(time(). 'akdfkjakd'));
	}
	
	protected function makePath() {
		return $this->directory.'/'.$this->generateRandomName().$this->getExtension();
	}
}

?>