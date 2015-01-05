<?php namespace KRDS\Extensions\Database;

use PDO;
use Illuminate\Database\SqlServerConnection;


class MySqlConnection extends \Illuminate\Database\Connection {

	protected function resetMode()
	{
		//$this->setFetchMode($this->app['config']['database.fetch']);
	}
	
	public function fetch_assoc($query, $bindings = array(), $useReadPdo = true)
	{
		$this->setFetchMode(PDO::FETCH_ASSOC);
		
		return $this->select($query, $bindings = array(), $useReadPdo = true);
	}

	public function fetch_column($query, $bindings = array(), $useReadPdo = true, $column_index = 0)
	{
		$this->setFetchMode(PDO::FETCH_ASSOC);
	
		//TODO
		return $this->select($query, $bindings = array(), $useReadPdo = true);
	}

	public function fetch_group($query, $bindings = array(), $useReadPdo = true)
	{
		$this->setFetchMode(PDO::FETCH_COLUMN | PDO::FETCH_GROUP);
	
		return $this->select($query, $bindings = array(), $useReadPdo = true);
	}
	
	public function fetch_group_assoc($query, $bindings = array(), $useReadPdo = true)
	{
		$this->setFetchMode(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
		
		return $this->select($query, $bindings = array(), $useReadPdo = true);
	}
	
	public function fetch_pair($query, $bindings = array(), $useReadPdo = true)
	{
		$this->setFetchMode(PDO::FETCH_KEY_PAIR);
		
		return $this->select($query, $bindings = array(), $useReadPdo = true);
	}
	
	public function fetch_row($query, $bindings = array(), $useReadPdo = true)
	{
		print_r($this->config);
	
		$this->setFetchMode(PDO::FETCH_NUM);
		
		return $this->select($query, $bindings = array(), $useReadPdo = true);
	}
	
	public function fetch_unique($query, $bindings = array(), $useReadPdo = true)
	{
		$this->setFetchMode(PDO::FETCH_ASSOC | PDO::FETCH_UNIQUE);
		
	}
}