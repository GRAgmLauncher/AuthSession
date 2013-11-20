<?php

namespace Models\Session;

class MySQLSessionProvider extends AbstractSessionProvider
{
	protected $SessionMapper;
	
	/**
	 * @param SessionFactory
	 * @param SessionMapper
	 * @return void
	 **/
	
	public function __construct ( \Models\Session\SessionMapper $SessionMapper ) {
		$this->SessionMapper = $SessionMapper;
	}
	
	public function getCurrentSession() {
		return $this->SessionMapper->fetchByID(session_id());
	}
		
	public function endSession(\Interfaces\SessionInterface $Session) {
		$this->SessionMapper->delete($Session);
	}
	
	public function storeSession(\Interfaces\SessionInterface $Session) {
		$this->SessionMapper->save($Session);
	}
}

?>