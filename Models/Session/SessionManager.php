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
	protected $SessionFactory;
	
	
	
	/**
	 * @param SessionProvider
	 * @return void
	 **/
	
	public function __construct ( \Models\Session\AbstractSessionProvider $SessionProvider, \Models\Session\SessionFactory $SessionFactory ) {
		$this->SessionProvider = $SessionProvider;
		$this->SessionFactory = $SessionFactory;
	}
	
	
	
	/**
	 * Begins session data, and returns a new session if no current valid session could be found
	 * @return Session (the newly created session)
	 **/
	
	public function initializeSession() {
		
		session_start();
		
		$Session = $this->SessionProvider->getCurrentSession();
		
		if ($this->validateSession($Session)) {
			return $this->updateSessionTimestamp($Session);
		} else {
			return $this->createSession();
		}
	}
	
	
	
	/**
	 * Updates the timestamp of the current session, and re-saves it
	 * @param Session
	 * @return void
	 **/
	
	public function updateSessionTimestamp(\Interfaces\SessionInterface $Session) {
		$Session->updateTimestamp();
		$this->SessionProvider->persist($Session);
		return $Session;
	}
		
	
	
	/**
	 * Populates and saves a new session object with either guest or user data
	 * @param User (optional)
	 * @return void
	 **/
	
	public function createSession($User = null) {
		
		$Session = $this->SessionFactory->make();
		
		if ($User instanceof \Interfaces\UserInterface) {
			$this->SessionProvider->endSession($this->SessionProvider->CurrentSession);
			$Session->populate($User);
		} else {
			$Session->populate();
		}
		
		$this->SessionProvider->persist($Session);
		return $Session;
	}
		
	
	
	/**
	 * Completely destroys all session data
	 * @return void
	 **/
	
	public function destroyCurrentSession() {
		$this->SessionProvider->endSession($this->SessionProvider->CurrentSession);
		session_destroy();
	}
	
	
	
	/**
	 * Checks for an existing session. If found, it checks the session's timestamp to make sure it's still valid. 
	 * If both conditions pass, the existing session is returned. 
	 * @return bool
	 **/
	 	 			
	protected function validateSession($Session) {
		if (!$Session instanceof \Interfaces\SessionInterface) {
			return false;
		}
		
		if (!$this->checkTimestamp($Session->time_stamp, SESSION_LIFETIME)) {
			$this->SessionProvider->endSession($Session);
			return false;
		}
		
		return true;
	}
	

	
	/**
	 * Checks to make sure the session's timestamp is still valid
	 * @param integer
	 * @param integer	 
	 * @return bool
	 **/
	 	
	protected function checkTimestamp($sessionTimestamp, $allowedTime) {
		if ($sessionTimestamp + $allowedTime < time()) {
			return false;
		}
		return true;
	}
}

?>