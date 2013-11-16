<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Core;

class PDOWrapper 
{
	protected $pdo;
	protected $fieldMap;
	protected $table;
	
	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}
	
	public function setFieldMap(Array $fieldMap)
	{
		$this->fieldMap = $fieldMap;
	}
	
	public function setTable($table)
	{
		$this->table = $table;
	}
	
	public function insert($obj)
	{
		
	}
	
	public function query($sql, $fields, $primary_key = null)
	{
		$stmt = $this->pdo->prepare($sql);
		
		foreach ($this->fieldMap as $fieldName => $fieldType)
		{
			$stmt->bindParam(":{$fieldName}", $fields[$fieldName], $this->_mapFieldType($fieldType));
		}
		
		if (is_array($primary_key))
		{
			$stmt->bindParam(':'.key($primary_key), $primary_key[0], \PDO::PARAM_INT);
		}
		
		$stmt->execute();
	}
	
	public function _getFieldData($obj)
	{
		$fields = array();
		
		foreach ($this->fieldMap as $fieldName => $fieldType)
		{
			$fields[$fieldName] = $obj[$fieldName];
		}
		
		return $fields;
	}
	
	private function _bindParams($stmt, $fields)
	{
		foreach ()
	}
	
	private function _mapFieldType($fieldType)
	{
		switch($fieldType)
		{
			case 'int':
				return \PDO::PARAM_INT;
			case 'primary':
				return \PDO::PARAM_INT;
			case 'bool':
				return \PDO::PARAM_BOOL;
			case 'string':
				return \PDO::PARAM_STR;
			default :
				return \PDO::PARAM_INT;
		}
	}
}

?>