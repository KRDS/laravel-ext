<?php namespace KRDS\Extensions\Database;

use PDO;

class MySqlConnection extends \Illuminate\Database\Connection {

	protected function fetch_assoc()
	{
		return $this->fetch(PDO::FETCH_ASSOC);
	}

	protected function fetch_column($column_index = 0)
	{
		return $this->fetch(PDO::FETCH_COLUMN, $column_index);
	}

	protected function fetch_group()
	{
		return $this->fetch(PDO::FETCH_COLUMN | PDO::FETCH_GROUP);
	}
	
	protected function fetch_group_assoc()
	{
		return $this->fetch(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
	}
	
	protected function fetch_pair()
	{
		return $this->fetch(PDO::FETCH_KEY_PAIR);
	}
	
	protected function fetch_row()
	{
		return $this->fetch(PDO::FETCH_NUM);
	}
	
	protected function fetch_unique()
	{
		return $this->fetch(PDO::FETCH_ASSOC | PDO::FETCH_UNIQUE);
	}
}