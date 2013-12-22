<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Image;

class ImageUploader {
	
	protected $tempDirectory;
	protected $ImageFactory;
	protected $SecurityHelper;
	
	public function __construct(\Framework\Image\ImageFactory $ImageFactory, \Framework\Security\SecurityHelper $SecurityHelper) {
		$this->tempDirectory = UPLOADS_TEMP . DIRECTORY_SEPARATOR;
		$this->ImageFactory = $ImageFactory;
		$this->SecurityHelper = $SecurityHelper;
	}
	
	
	public function upload($field, $name, $directory, $required = true) 
	{
		// 0. Check to makes sure the image has been uploaded
		if (!$this->validateUpload($field, $required)) {
			return;
		}
		
		// 1. Move uploaded file into temporary copy
		if (!$TempImage = $this->makeTemporaryImage($field)) {
			return false;
		}
		
		// 2. Resave temporary copy to strip out any nasties
		$FinalImage = $TempImage->saveCopy($name, $directory);
		
		
		// 3. Delete the potentially unsafe temporary image
		$TempImage->delete();
		
		
		// 4. Return the final image
		return $FinalImage;
				
	}
	
	
	protected function makeTemporaryImage($field) 
	{
		// 1. Create an image object from the temp upload file
		$Image = $this->ImageFactory->make($_FILES[$field]['tmp_name']);

		// 2. Create a random name and set the path and extension for the directory the image is being moved to
		$randomName = $this->SecurityHelper->randomString(64);
		$extension = $Image->getImageExtension();
		$tempPath = $this->tempDirectory.$randomName.$extension;
		
		// 3. Move the uploaded file
		@move_uploaded_file($Image->getFullPath(), $tempPath);
		
		
		// 4. Return a new image object for the newly moved file
		return $this->ImageFactory->make($tempPath);
	}
	
	protected function validateUpload($field, $required) {
		if (!isset($_FILES[$field]) || $_FILES[$field]['error'] == 4) {
			if ($required) {
				throw new \Exception('Image is required');
			}
			return false;
		}
		
		return true;
	}

}

?>