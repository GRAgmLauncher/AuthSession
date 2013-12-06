<?php

namespace Framework\Session;

/**
 * Service object for managing sessions (starting a session, updating it, ending it etc)
 * All this object needs to function is a factory that creates new sessions, and a data mapper that saves the sessions
 * To use, instantiate the object and then call initializeSession() anywhere before you need to use session data
 */


abstract class AbstractSessionProvider
{
	
	public $CurrentSession;

	/**
	 * Caches the session as the current session, and stores the session according to the chosen provider's storage mechanism
	 * @param Session	 
	 * @return void
	 **/
	 	
	public function persist(\Framework\Interfaces\SessionInterface $Session) {
		$this->storeSession($Session);
		$this->CurrentSession = $Session;
	}
	
	
	abstract public function getCurrentSession();
	abstract public function storeSession(\Framework\Interfaces\SessionInterface $Session);
	abstract public function endSession(\Framework\Interfaces\SessionInterface $Session);
}

?>