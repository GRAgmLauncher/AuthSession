<?php

namespace Framework;

class MapperObject
{
	protected $db;
	protected $obj;
	protected $conditions;
	
	public function __construct($obj, $db)
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
		$field = $this->getDataField($field);
		$fieldName = $field->getName();
		$fieldType = $field->getType();
		
		$stmt = $this->db->prepare("SELECT * FROM `{$this->table}` WHERE `{$fieldName}` = :{$fieldName}");
		$stmt->bindParam(":{$fieldName}", $value, $this->_mapFieldType($fieldType));
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

	
	public function save($obj)
	{
		return $this->_insertUpdate($obj);
	}
	
	
	protected function _insertUpdate($obj)	
	{
		$fields = $this->getDataFields();
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
	
	public function delete($obj)
	{
		$sql = "DELETE FROM `{$this->table}` WHERE `id` = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":id", $obj->id, $this->_mapFieldType($this->getDataField('id')->getType()));
		$stmt->execute();
	}
	
	
	public function _bindFields($stmt, $obj, $fields)
	{
		foreach ($fields as $fieldName => $fieldData){
			$stmt->bindParam(':'.$fieldName, $obj->$fieldName, $this->_mapFieldType($fieldData->getType()));
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
			case 'float':
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
	
	private function getDataField($field) {
		$reflection = new \ReflectionClass($this->obj);
		$property = $reflection->getProperty($field);
		return new \Framework\DataFieldReflector($property);
	}
		
	private function getDataFields() {
		$fields = array();
		$reflection = new \ReflectionClass($this->obj);
		foreach ($reflection->getProperties() as $property) {
			$field = new \Framework\DataFieldReflector($property);
			$fields[$property->getName()] = $field;
		}
		return $fields;
	}
}

?>