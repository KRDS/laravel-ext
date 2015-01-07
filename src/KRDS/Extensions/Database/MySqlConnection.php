<?php namespace KRDS\Extensions\Database;

use PDO;

class MySqlConnection extends \Illuminate\Database\Connection {

	public function select($query, $bindings = array(), $useReadPdo = true, $fetchMode = null, $fetchArgument = null)
	{
		return $this->run($query, $bindings, function($me, $query, $bindings) use ($useReadPdo, $fetchMode, $fetchArgument)
		{
			if ($me->pretending()) return array();

			// For select statements, we'll simply execute the query and return an array
			// of the database result set. Each element in the array will be a single
			// row from the database table, and will either be an array or objects.
			$statement = $this->getPdoForSelect($useReadPdo)->prepare($query);

			$statement->execute($me->prepareBindings($bindings));
			
			// Use the default fetch mode if no query-specific fetch mode passed
			if ( ! $fetchMode) $fetchMode = $me->getFetchMode();
			
			if ($fetchArgument !== null)
			{
				$data	=	$statement->fetchAll($fetchMode, $fetchArgument);
			}
			else
			{
				$data	=	$statement->fetchAll($fetchMode);
			}
			
			return $data;
		});
	}
	
	public function fetchAssoc($query, $bindings = array(), $useReadPdo = true)
	{		
		return $this->select($query, $bindings, $useReadPdo, PDO::FETCH_ASSOC);
	}

	public function fetchGroup($query, $bindings = array(), $useReadPdo = true)
	{	
		return $this->select($query, $bindings, $useReadPdo, PDO::FETCH_COLUMN | PDO::FETCH_GROUP);
	}
	
	public function fetchGroupAssoc($query, $bindings = array(), $useReadPdo = true)
	{		
		return $this->select($query, $bindings, $useReadPdo, PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
	}
	
	public function fetchPair($query, $bindings = array(), $useReadPdo = true)
	{		
		return $this->select($query, $bindings, $useReadPdo, PDO::FETCH_KEY_PAIR);
	}
	
	public function fetchRow($query, $bindings = array(), $useReadPdo = true)
	{			
		return $this->select($query, $bindings, $useReadPdo, PDO::FETCH_NUM);
	}
	
	public function fetchUnique($query, $bindings = array(), $useReadPdo = true)
	{		
		return $this->select($query, $bindings, $useReadPdo, PDO::FETCH_ASSOC | PDO::FETCH_UNIQUE);
	}
	
	public function fetchColumn($query, $bindings = array(), $useReadPdo = true, $columnIndex = 0)
	{	
		return $this->select($query, $bindings , $useReadPdo, PDO::FETCH_COLUMN, $columnIndex);
	}
}