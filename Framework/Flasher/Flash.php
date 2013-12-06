<?php

namespace Framework\Flasher;

class Flash
{
	protected $FlashStorage;
	protected $FlashMessageFactory;
	
	public function __construct(\Framework\Interfaces\FlashStorageInterface $FlashStorage, \Framework\Flasher\FlashMessageFactory $FlashMessageFactory)
	{
		$this->FlashStorage = $FlashStorage;
		$this->FlashMessageFactory = $FlashMessageFactory;
	}
	
	public function setMessage($message, $color = 'green') {
		$FlashMessage = $this->FlashMessageFactory->make($message, $color);
		$this->FlashStorage->store($FlashMessage);
	}
	
	public function getMessage() {
		$FlashMessage = $this->FlashStorage->retrieve();
		if (!$FlashMessage) {
			$FlashMessage = $this->FlashMessageFactory->make(null, null);
		}
		
		return $FlashMessage;
	}
}



?>