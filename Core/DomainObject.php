<?php

namespace Core;

class DomainObject
{
	public function getID()
	{
		return $this->id;
	}
	
	public function hasID()
	{
		if ($this->getID() != NULL || $this->getID() > 0)
		{
			return TRUE;
		}
		
		return FALSE;
	}
}

?>