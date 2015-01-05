<?php namespace KRDS\Extensions\Database;

use KRDS\Extensions\Database\Connectors\ConnectionFactory;

class DatabaseServiceProvider extends \Illuminate\Database\DatabaseServiceProvider {

    public function boot()
    {
		$this->app->bindShared('db.factory', function($app)
		{
			return new ConnectionFactory($app);
		});

		parent::boot();
	}
}