<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Filesystem;

class FileManager 
{
	public function delete(\Framework\Filesystem\File $File) {
		@unlink($File);
	}
}
?>