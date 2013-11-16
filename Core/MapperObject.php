<?php

namespace Core;

class MapperObject
{
	protected $db;
	protected $obj;
	protected $conditions;
	
	public function __construct(DomainObject $obj, $db)
	{
		$this->obj = $obj;
		$this->db = $db;
	}
	
	public function fetchByID($id)
	{
		return $this->fetchWhere('id', $id);
	}
	
	
	public function fetchWhere($field, $value)
	{
		$stmt = $this->db->prepare("SELECT * FROM `{$this->table}` WHERE `{$field}` = :{$field}");
		$stmt->bindParam(":{$field}", $value, $this->_mapFieldType($this->fields[$field]));
		$stmt->execute();
		$stmt->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, get_class($this->obj)); 
		return $stmt->fetch();
	}
	
	
	public function fetchAll($limit = null)
	{
		$sql = "SELECT * FROM `{$this->table}`";
		$sql .= $this->_addLimit($limit);
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, get_class($this->obj)); 
		return $stmt->fetchAll();
	}

	
	public function save(DomainObject $obj)
	{
		return $this->_insertUpdate($obj, $this->fields);
	}
	
	
	protected function _insertUpdate($obj, $fields)	
	{
		$sql = "INSERT INTO `{$this->table}`(";
		$sql .= implode(', ', array_keys($fields));
		$sql .= ") VALUES (:";
		$sql .= implode(', :', array_keys($fields)) .")";
		$sql .= " ON DUPLICATE KEY UPDATE ";
		array_walk($fields, function($value, $key) use (&$sql) {
			$sql .= "{$key} = :{$key}, ";
		});
		
		$sql = trim($sql, ", ");
		
		$stmt = $this->db->prepare($sql);
		
		$this->_bindFields($stmt, $obj, $fields);
		
		$stmt->execute();
		
		if ($this->db->lastInsertId() != 0 )
		{
			$obj->id = $this->db->lastInsertId();
		}
		
		return $obj;
	}
	
	public function delete(DomainObject $obj)
	{
		$sql = "DELETE FROM `{$this->table}` WHERE `id` = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":id", $obj->getID(), $this->_mapFieldType($this->fields['id']));
		$stmt->execute();
	}
	
	
	public function _bindFields($stmt, $obj, $fields)
	{
		foreach ($fields as $fieldName => $fieldType)
		{
			$stmt->bindParam(':'.$fieldName, $obj->$fieldName, $this->_mapFieldType($fieldType));
		}
	}
	
	
	private function _mapFieldType($fieldType)
	{
		switch($fieldType)
		{
			case 'int':
				return \PDO::PARAM_INT;
			case 'bool':
				return \PDO::PARAM_BOOL;
			case 'string':
				return \PDO::PARAM_STR;
			default :
				return \PDO::PARAM_INT;
		}
	}
	
	
	private function _addLimit($limit)
	{
		if ($limit)
		{
			return " LIMIT {$limit}";
		}
	}
}

?>