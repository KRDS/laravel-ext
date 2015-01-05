<?php namespace KRDS\Extensions\Database\Connectors;

use PDO;
use KRDS\Extensions\Database\MySqlConnection;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Database\PostgresConnection;
use Illuminate\Database\SqlServerConnection;

class ConnectionFactory extends Illuminate\Database\Connectors\ConnectionFactory {

	protected function createConnection($driver, PDO $connection, $database, $prefix = '', array $config = array())
	{
		if ($this->container->bound($key = "db.connection.{$driver}"))
		{
			return $this->container->make($key, array($connection, $database, $prefix, $config));
		}

		switch ($driver)
		{
			case 'mysql':
				return new MySqlConnection($connection, $database, $prefix, $config);

			case 'pgsql':
				return new PostgresConnection($connection, $database, $prefix, $config);

			case 'sqlite':
				return new SQLiteConnection($connection, $database, $prefix, $config);

			case 'sqlsrv':
				return new SqlServerConnection($connection, $database, $prefix, $config);
		}

		throw new \InvalidArgumentException("Unsupported driver [$driver]");
	}
}
