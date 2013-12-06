<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Image;

class Image extends \Framework\Filesystem\File {
	
	protected $width;
	protected $height;
	protected $mime;
	protected $type;
	
	public function __construct($src = null) {
		parent::__construct($src);
		if ($data = @getimagesize($src)) {
			$this->setWidth($data[0]);
			$this->setHeight($data[1]);
			$this->type = (int)$data[2];
			$this->mime = $data['mime'];
		}
	}

	public function setWidth($width) {
		$this->width = $width;
	}
	
	public function getWidth() {
		return $this->width;
	}
	
	public function setHeight($height) {
		$this->height = $height;
	}
	
	public function getHeight() {
		return $this->height;
	}
	
	public function getRatio() {
		return $this->getWidth() / $this->getHeight();
	}
	
	public function getImageExtension() {
		switch ($this->type) {
			case 1:
				return '.gif';
			case 2: 
				return '.jpg';
			case 3:
				return '.png';
			default:
				return null;
		}
	}
	
	public function resize($maxWidth, $maxHeight) {
		$ratio = $this->getRatio();
		$this->setWidth($maxWidth);
		$this->setHeight($maxWidth / $ratio);
		
		if ($ratio < 1) {
			$this->setHeight($maxHeight);
			$this->setWidth($maxHeight * $ratio);
		}
	}

	
	public function saveCopy($name, $path, $maxWidth = null, $maxHeight = null, $quality = 100) {
		$target = clone $this;
		$target->setName($name);
		$target->setDirectory($path);
		
		if ($maxWidth && $maxHeight) {
			$target->resize($maxWidth, $maxHeight);
		}
		
		$dst = imagecreatetruecolor($target->getWidth(), $target->getHeight());
		$src = imagecreatefromjpeg($this->getFullPath());
		
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $target->getWidth(), $target->getHeight(), $this->getWidth(), $this->getHeight());
		
		imagejpeg($dst, $target->getFullPath(), $quality);
		imagedestroy($dst);
		
		return $target;
	}
	
	
}

?>