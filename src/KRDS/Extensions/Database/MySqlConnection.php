<?php namespace KRDS\Extensions\Database;

use PDO;
use Illuminate\Database\SqlServerConnection;


class MySqlConnection extends \Illuminate\Database\Connection {

	public function select($query, $bindings = array(), $useReadPdo = true, $fetchArgument = null)
	{
		return $this->run($query, $bindings, function($me, $query, $bindings) use ($useReadPdo, $fetchArgument)
		{
			if ($me->pretending()) return array();

			// For select statements, we'll simply execute the query and return an array
			// of the database result set. Each element in the array will be a single
			// row from the database table, and will either be an array or objects.
			$statement = $this->getPdoForSelect($useReadPdo)->prepare($query);

			$statement->execute($me->prepareBindings($bindings));

			if($me->getFetchMode() === PDO::FETCH_COLUMN)
				return $statement->fetchAll($me->getFetchMode(), $fetchArgument);
			else
				return $statement->fetchAll($me->getFetchMode());
		});
	}
	
	protected function resetFetchMode()
	{		
		$this->setFetchMode($this->config['fetch']);
	}
	
	public function fetchAssoc($query, $bindings = array(), $useReadPdo = true)
	{
		$this->setFetchMode(PDO::FETCH_ASSOC);
		
		return $this->select($query, $bindings = array(), $useReadPdo = true);
	}

	public function fetchGroup($query, $bindings = array(), $useReadPdo = true)
	{
		$this->setFetchMode(PDO::FETCH_COLUMN | PDO::FETCH_GROUP);
	
		return $this->select($query, $bindings = array(), $useReadPdo = true);
	}
	
	public function fetchGroupAssoc($query, $bindings = array(), $useReadPdo = true)
	{
		$this->setFetchMode(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
		
		return $this->select($query, $bindings = array(), $useReadPdo = true);
	}
	
	public function fetchPair($query, $bindings = array(), $useReadPdo = true)
	{
		$this->setFetchMode(PDO::FETCH_KEY_PAIR);
		
		return $this->select($query, $bindings = array(), $useReadPdo = true);
	}
	
	public function fetchRow($query, $bindings = array(), $useReadPdo = true)
	{	
		print_r($this->config);
	
		$this->setFetchMode(PDO::FETCH_NUM);
		
		return $this->select($query, $bindings = array(), $useReadPdo = true);
	}
	
	public function fetchUnique($query, $bindings = array(), $useReadPdo = true)
	{
		$this->setFetchMode(PDO::FETCH_ASSOC | PDO::FETCH_UNIQUE);
		
		return $this->select($query, $bindings = array(), $useReadPdo = true);
	}
	
	public function fetchColumn($query, $bindings = array(), $useReadPdo = true, $columnIndex = 0)
	{
		$this->setFetchMode(PDO::FETCH_COLUMN);
	
		return $this->select($query, $bindings = array(), $useReadPdo = true, $columnIndex = 0);
	}
}