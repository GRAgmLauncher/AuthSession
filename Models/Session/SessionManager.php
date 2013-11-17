<?php

namespace Models\Session;

/**
 * Service object for managing sessions (starting a session, updating it, ending it etc)
 * All this object needs to function is any kind of SessionProvider (e.g. a database session provider, or a memory session provider), it doesn't care which kind of provider it gets
 */

class SessionManager
{
	
	/**
	 * @var SessionProvider
	 */
	protected $SessionProvider;
	
	
	
	/**
	 * @param SessionProvider
	 * @return void
	 **/
	
	public function __construct ( \Models\Session\AbstractSessionProvider $SessionProvider ) {
		$this->SessionProvider = $SessionProvider;
	}
	
	
	
	/**
	 * Calls the initializeSession() method of the given provider
	 * @return Session (the newly created session)
	 **/
	
	public function initializeSession() {
		session_start();
		return $this->SessionProvider->initializeSession();
	}
	
	
	
	/**
	 * Calls the updateSessionTimestamp of the given provider
	 * @param Session
	 * @return void
	 **/
	
	public function updateSessionTimestamp(\Interfaces\SessionInterface $Session) {
		$this->SessionProvider->updateSessionTimestamp($Session);
	}
		
	
	
	/**
	 * Calls the appropriate session type creation method of the given provider
	 * @param User (optional)
	 * @return void
	 **/
	
	public function createSession(\Interfaces\UserInterface $User = null) {
		if ($User) {
			$this->SessionProvider->createUserSession($User);
		} else {
			$this->SessionProvider->createGuestSession();
		}
	}
	
		
	
	/**
	 * Calls the endCurrentSession() method of the given provider
	 * @return void
	 **/
	
	public function endCurrentSession() {
		$this->SessionProvider->endCurrentSession();
		session_regenerate_id(true);
		session_destroy();
	}
}

?>