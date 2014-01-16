<?php
namespace Framework;
class Mapper 
{
	protected $db;
	protected $Injector;
	public $proxy;
	public $metaProxy;
	public $parentMetaProxy;
	public $table;
	public $whereField;
	private $childQuery = false;
	
	public function __construct(\PDO $db, \Framework\Autoinjector $Injector) {
		$this->db = $db;
		$this->Injector = $Injector;
	}
	
	public function find($object) {
		$this->proxy = $this->Injector->create($object);
		$this->metaProxy = new \Framework\Meta\MetaClass($object);
		
		
		return $this;
	}
	
	public function findChild($parent, $child) {
		$this->proxy = $this->Injector->create($child);
		$this->metaProxy = new \Framework\Meta\MetaClass($child);
		$this->parentMetaProxy = new \Framework\Meta\MetaClass($parent);
		
		$this->childQuery = true;
		return $this;
	}
	
	public function where($field) {
		$this->whereField = $this->metaProxy->getField($field);
		return $this;
	}

	public function in($values)
	{
		$placeholders = implode(',', array_fill(0, count($values), '?'));
		//$values = array_map('intval', $values);
		
		if ($this->childQuery) {
			$sql = $this->makeSQLtoFindChildren();
		} else {
			$sql = $this->makeSQLtoFindObject();
		}
		
		$sql .= "({$placeholders})";

		$stmt = $this->db->prepare($sql);
		$object = clone $this->proxy;
		$stmt->setFetchMode(\PDO::FETCH_INTO|\PDO::FETCH_PROPS_LATE, $object);

		$stmt->execute($values);
		
		$collection = array();

		foreach ($stmt as $obj) {
			$collection[] = clone $obj;
		}
		
		if ($this->childQuery)
		{
			array_multisort($values, $collection);
		}
		
		$this->flush();
		return $collection;
	}
		
	protected function makeSQLtoFindObject() {
		$fields = $this->metaProxy->getScalarFieldsAsString();
		$table = $this->metaProxy->table;
		$fieldName = $this->whereField->name;
		
		return "SELECT * FROM `{$table}` WHERE `{$fieldName}` IN ";
	}
	
	protected function makeSQLtoFindChildren() {
		$fields = $this->metaProxy->getScalarFieldsAsString();
		$table2 = $this->metaProxy->table;
		$table1 = $this->parentMetaProxy->table;
		
		return "SELECT * 
					FROM `{$table2}`
					LEFT JOIN {$table1}_{$table2} 
						ON ({$table1}_{$table2}.{$table2}_id = {$table2}.id)
					WHERE {$table1}_{$table2}.{$table1}_id IN ";
	}

	private function flush() {
		$this->object = null;
		$this->table = null;
		$this->proxy = null;
		$this->metaProxy = null;
		$this->parentMetaProxy = null;
		$this->childQuery = false;
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
}