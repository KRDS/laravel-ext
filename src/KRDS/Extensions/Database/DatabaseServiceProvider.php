<?php namespace KRDS\Extensions\Database;

use KRDS\Extensions\Database\Connectors\ConnectionFactory;
use Illuminate\Foundation\Application as App;

class DatabaseServiceProvider extends \Illuminate\Database\DatabaseServiceProvider {

    public function boot()
    {
		App::bindShared('db.factory', function($app)
		{
			return new ConnectionFactory($app);
		});

		parent::boot();
	}
}