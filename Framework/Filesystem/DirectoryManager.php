<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Filesystem;

class DirectoryManager
{
	public function make($directory) {
		touch($directory);
	}
}
?>