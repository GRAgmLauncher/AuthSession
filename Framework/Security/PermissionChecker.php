<?php

namespace Framework\Security;

class PermissionChecker
{
	protected $Redirect;
	protected $Session;

	public function __construct(\Framework\Session\Session $Session, \Framework\Redirect $Redirect)
	{
		$this->Session = $Session;
		$this->Redirect = $Redirect;
	}

	public function atLeast($level, $returnOnly = false) {
		if ($this->Session->User->Group->permission_level < $level) {
			if ($returnOnly) {
				return false;
			}
			$this->Redirect->to('/404');
		}
	}
	
	public function is($level, $returnOnly = false) {
		if ($this->Session->User->Group->permission_level != $level) {
			if ($returnOnly) {
				return false;
			}
			$this->Redirect->to('/404');
		}
	}
	
	public function isAdmin($returnOnly = false) {
		if (!$this->Session->User->isAdmin()) {
			if ($returnOnly) {
				return false;
			}
			$this->Redirect->to('/404');
		}
	}
}

?>