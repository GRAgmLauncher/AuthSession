<?php

namespace Framework\Session;

class MemorySessionProvider extends AbstractSessionProvider
{
	public function getCurrentSession() {
		if (isset($_SESSION['s'])) {
			return $_SESSION['s'];
		}
		return false;
	}
		
	public function endSession(\Framework\Interfaces\SessionInterface $Session) {
		$_SESSION = null;
	}
	
	public function storeSession(\Framework\Interfaces\SessionInterface $Session) {
		$_SESSION['s'] = $Session;
	}
}

?>