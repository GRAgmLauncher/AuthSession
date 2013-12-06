<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Controllers;

class ImageController extends \Controllers\CoreController
{
	public function upload() {
		
		if ($this->Input['submit']) {
			$Image = $this->ImageUploader->upload('myimage', 'herpy', UPLOADS.'\\originals');
			$Image->saveCopy('image_copy', UPLOADS.'\\large', 1200, 100, 75);
			$Image->saveCopy('image_copy_thumb', UPLOADS.'\\thumbs', 300, 300, 75);
		}
	}
}

?>