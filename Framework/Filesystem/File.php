<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Filesystem;

class File 
{
	protected $dirName;
	protected $fileName;
	protected $extension;
	protected $fileSize;
	
	public function __construct($path) {
		if (!file_exists($path)) {
			return;	
		}
		
		$pathinfo = pathinfo($path);
		$this->dirName = $pathinfo['dirname'];
		$this->fileName = $pathinfo['filename'];
		$this->extension = $pathinfo['extension'];
		$this->fileSize = filesize($path);
	}
	
		
	public function setDirectory($path) {
		$this->dirName = $path;
	}
	
	public function setName($name) {
		$this->fileName = $name;
	}
	
	public function getDirectory() {
		$dir = rtrim($this->dirName, DIRECTORY_SEPARATOR);
		return $dir . DIRECTORY_SEPARATOR;
	}
	
	public function getName() {
		return $this->fileName;
	}
	
	public function getBaseName() {
		if ($this->getName() && $this->getExtension()) {
			return $this->getName().'.'.$this->getExtension();
		}
	}
	
	public function getExtension() {
		return $this->extension;
	}
	
	public function getSize() {
		return $this->fileSize;
	}
	
	public function getFullPath() {
		return $this->getDirectory().$this->getBaseName();
	}
	
	public function delete() {
		unlink($this->getFullPath());
	}
}

?>