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
	
	public function __construct ( \Models\Session\SessionFactory $SessionFactory, \Models\Session\SessionMapper $SessionMapper ) {
		parent::__construct($SessionFactory);
		$this->SessionMapper = $SessionMapper;
	}
	
	protected function getSession() {
		if ($Session = $this->SessionMapper->fetchByID(session_id())) {
			return $Session;
		}
		return false;
	}
		
	public function endSession(\Interfaces\SessionInterface $Session) {
		$this->SessionMapper->delete($Session);	
	}
	
	public function getStorageMethod() {
		return 'MySQL';
	}
	
	protected function store(\Interfaces\SessionInterface $Session) {
		$this->SessionMapper->save($Session);
	}
}

?>