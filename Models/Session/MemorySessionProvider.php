<?php

namespace Models\Session;

class MemorySessionProvider extends AbstractSessionProvider
{
	public function getCurrentSession() {
		if (isset($_SESSION['s'])) {
			return $_SESSION['s'];
		}
		return false;
	}
		
	public function endSession(\Interfaces\SessionInterface $Session) {
		$_SESSION = null;
	}
	
	public function storeSession(\Interfaces\SessionInterface $Session) {
		$_SESSION['s'] = $Session;
	}
}

?>