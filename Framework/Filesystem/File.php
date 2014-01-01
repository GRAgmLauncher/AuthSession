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
	
	public function getSizeKb() {
		return round($this->getSize()/1024, 2);
	}
	
	public function getFullPath() {
		return $this->getDirectory().$this->getBaseName();
	}
	
	public function delete() {
		unlink($this->getFullPath());
	}
	
	public function rename($newName) {
		rename($this->getDirectory().$this->getName().'.'.$this->getExtension(), $this->getDirectory().$newName.'.'.$this->getExtension());
	}
	
	public function move() {
		// TODO
	}
	
	public function getURL() {
		$path = $this->getFullPath();
		$path = str_replace(ROOT_PATH, '', $path);
		return str_replace('\\', '/', $path);
	}
}

?>