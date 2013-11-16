<?php

namespace Models\Session;

class MemorySessionProvider extends AbstractSessionProvider
{
	protected function getSession() {
		if (isset($_SESSION['sessionData']) && $_SESSION['sessionData'] instanceof \Interfaces\SessionInterface) {
			return $_SESSION['sessionData'];
		}
		return false;
	}
		
	public function endSession(\Interfaces\SessionInterface $Session) {
		$_SESSION = null;
	}
	
	public function getStorageMethod() {
		return 'Memory';
	}
	
	protected function store(\Interfaces\SessionInterface $Session) {
		$_SESSION['sessionData'] = $Session;
	}
}

?>