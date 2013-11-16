<?php

namespace Models\Session;

/**
 * Service object for managing sessions (starting a session, updating it, ending it etc)
 * All this object needs to function is a factory that creates new sessions, and a data mapper that saves the sessions
 * To use, instantiate the object and then call initializeSession() anywhere before you need to use session data
 */


abstract class AbstractSessionProvider
{
	protected $SessionFactory;
	protected $CurrentSession;
	
	/**
	 * @param SessionFactory
	 * @return void
	 **/
	
	public function __construct ( \Models\Session\SessionFactory $SessionFactory ) {
		$this->SessionFactory = $SessionFactory;
	}
	
	
	
	/**
	 * The starting point for session creation. Call this method before any session-related behavior is needed
	 * @return Session
	 **/
	
	public function initializeSession() {
		
		if ($Session = $this->validateSession()) {
			$this->updateSessionTimestamp($Session);
		} else {
			$this->createGuestSession();
		}
		return $this->CurrentSession;
	}
	
	
	
	/**
	 * Updates the timestamp of the given session, and then re-saves it
	 * @param Session
	 * @return void
	 **/
	
	public function updateSessionTimestamp(\Interfaces\SessionInterface $Session) {
		$Session->updateTimestamp();
		$this->persist($Session);
	}
	
	
	
	/**
	 * Creates a brand new session based on the given User object
	 * @param User $User
	 * @return void
	 **/
	
	public function createUserSession(\Interfaces\UserInterface $User) {
		$Session = $this->SessionFactory->make();				// Instantiate a blank session
		$Session->populate($User);								// Populate the session with User data
		$this->endCurrentSession();
		$this->persist($Session);
	}
	
	
	
	/**
	 * Creates a brand new session based on some default parameters that indicate an anonymous guest user
	 * @return void
	 **/
	
	public function createGuestSession() {
		$Session = $this->SessionFactory->make();		// The GuestSession constructor constructs a guest session by default
		$Session->populate();							// Populate the session with default guest data
		$this->persist($Session);						// Save the new session
	}
	
	
	
	/**
	 * Ends and destroys the current session, removing it from persistence and from memory
	 * @return void
	 **/
	
	public function endCurrentSession() {
		$this->endSession($this->CurrentSession);
	}
	
	
	
	/**
	 * Checks for an existing session. If found, it checks the session's timestamp to make sure it's still valid. 
	 * If both conditions pass, the existing session is returned. 
	 * @return mixed (Session, false)
	 **/
	 	 			
	protected function validateSession() {
		if (!$Session = $this->getSession()) {
			return false;
		}
		
		if (!$this->checkTimestamp($Session->time_stamp, 30)) {
			$this->endSession($Session);
			return false;
		}
		
		return $Session;
	}


	
	/**
	 * Caches the session as the current session, and stores the session according to the chosen provider's storage mechanism
	 * @param Session	 
	 * @return void
	 **/
	 	
	protected function persist(\Interfaces\SessionInterface $Session) {
		$this->store($Session);
		$this->CurrentSession = $Session;
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
	
	abstract protected function getSession();
	abstract protected function store(\Interfaces\SessionInterface $Session);
	abstract public function endSession(\Interfaces\SessionInterface $Session);
	abstract public function getStorageMethod();
}

?>