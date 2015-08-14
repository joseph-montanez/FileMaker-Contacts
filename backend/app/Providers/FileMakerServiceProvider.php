<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FileMakerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    	$this->app->singleton('FileMaker', function ($app) {
    		$environment = app()->environment();
    		$db = $_ENV['FILEMAKER_DATABASE'];
    		$host = $_ENV['FILEMAKER_SERVER'];
    		$user = $_ENV['FILEMAKER_USERNAME'];
    		$pass = $_ENV['FILEMAKER_PASSWORD'];
			$fm = new \FileMaker ($db, $host, $user, $pass);
            return $fm;
        });
    }
}
