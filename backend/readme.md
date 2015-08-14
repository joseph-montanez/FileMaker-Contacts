## FileMaker Contacts Demo

This is a sample backend application that uses [FileMaker Server 14](https://www.filemaker.com/products/filemaker-server/), and [Lumen 5.1](http://lumen.laravel.com). This used to serve requests to the [Front End](../frontend) application.

### FileMaker Code

Each FileMaker Server version requires specific PHP versions and its own library. I've included the version for FileMaker Server 14, this wrapped in a service provider that can be called with Lumen's injection layer. For example to grab the FileMaker instance, you can call the following:

#### app/Http/routes.php

	$app->get('/layouts', function () use ($app) {
		$fm = $app->make('FileMaker');
		//-- Your code here...
		$record = $fm->getRecordById('', '');
	});

The service provide is a simple singleton wrapper as shown below:

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

If you look at the service provider, it uses $_ENV, these are variables available in the `.env` file. When you clone this repo, you do not get `.env`, but rather `.env.example`. Simple rename `.env.example` to `.env`, and edit the file accordingly. Here are the variables inside the file that are important to the FileMaker Server connection:

	FILEMAKER_SERVER=server
	FILEMAKER_DATABASE=Contacts
	FILEMAKER_USERNAME=admin
	FILEMAKER_PASSWORD=admin


### Running the application

This can happen a few ways, you already have Composer and PHP installed, you can just run the following:

	composer install
	php artisan serve

If you don't have those things installed, then you need to look at the [INSTALL](./INSTALL.md) document in this folder. It talks about Virtual Box, Vagrant and Homestead. Using that type of setup lets multiple developers work on the project with the same setup.

### License

The Lumen framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
