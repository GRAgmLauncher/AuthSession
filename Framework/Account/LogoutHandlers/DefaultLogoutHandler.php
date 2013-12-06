<?php

namespace Framework\Account\LogoutHandlers;

class DefaultLogoutHandler extends AbstractLogoutHandler
{
	public function logout() {
		$this->SessionManager->destroyCurrentSession();
	}
}

?>