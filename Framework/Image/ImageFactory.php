<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Image;

class ImageFactory {

	public function make($src) {
		return new \Framework\Image\Image($src);
	}
}
?>