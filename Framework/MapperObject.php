<?php

namespace Framework;

class MapperObject
{
	protected $db;
	protected $Tree;

	public function __construct(\PDO $db/*, \Framework\ORM\RelationTree $Tree*/)
	{
		$this->db = $db;
		//$this->Tree = $Tree;
	}
	
	public function fetchByID($id)
	{
		if (is_array($id)) {
			return $this->fetchWhereIn('id', $id);
		}
		
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
		$stmt->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, $this->proxy);
		
		$builtObject = $stmt->fetch();
		
		$this->buildChildren($builtObject);
		//$this->readChildren();
		
		return $builtObject;
	}
	
	/*public function fetchWhereIn($field, $values) 
	{
		$field = $this->getDataField($field);
		$fieldName = $field->getName();
		$fieldType = $field->getType();
		$placeholders = implode(',', array_fill(0, count($values), '?'));
		$values = array_map('intval', $values);
	
		$stmt = $this->db->prepare("SELECT * FROM `{$this->table}` WHERE `{$fieldName}` IN ({$placeholders})");
		$stmt->execute($values);
		$stmt->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, $this->proxy);
		$objects = $stmt->fetchAll();
		
		debug($objects);
	}*/
	
	
	public function fetchAll($limit = null)
	{
		$sql = "SELECT * FROM `{$this->table}`";
		$sql .= $this->_addLimit($limit);
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, $this->proxy);
		$objects = $stmt->fetchAll();
		
		foreach ($objects as &$object) {
			$this->buildChildren($object);
		}
		debug($objects);
		return $objects;
	}

	
	public function save($obj)
	{
		$this->_insertUpdate($obj);
	}
	
	
	protected function _insertUpdate($obj)	
	{
		$fields = $this->getDataFields($obj);
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
		
		if ($this->db->lastInsertId() != 0 ) {
			$obj->id = $this->db->lastInsertId();
		}
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
		$reflection = new \ReflectionClass($this->proxy);
		$property = $reflection->getProperty($field);
		return new \Framework\DataFieldReflector($property);
	}
		
	private function getDataFields($object) {
		$fields = array();
		$reflection = new \ReflectionClass($object);
		foreach ($reflection->getProperties() as $property) {
			$field = new \Framework\DataFieldReflector($property);
			if (in_array($field->getType(), array('string', 'int', 'float', 'bool'))) {
				$fields[$property->getName()] = $field;
			}
		}
		return $fields;
	}
	
	private function readChildren() {
		$this->Tree->findChild($this->proxy);
		debug($this->Tree);
	}
	
	private function buildChildren($builtObject) {
	
		if (!$builtObject) {
			return;
		}
		
		if (method_exists($this, 'addChildren')) {
			$this->addChildren($builtObject);
		}
	}
}

?>