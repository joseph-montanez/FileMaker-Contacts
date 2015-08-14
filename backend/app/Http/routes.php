<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->welcome();
});


//-- TODO move this into a controller!
$app->get('/layouts', function () use ($app) {
	$fm = $app->make('FileMaker');

	// Call listLayouts() to get array of layout names.
	$layouts = $fm->listLayouts();


	$status = true;
	$message = [];

	// If an error is found, return a message and exit.
	if (FileMaker::isError($layouts)) {
		$status = false;
	    $message = sprintf("Error %s: %s", $layouts->getCode(), $layouts->getMessage());
	} else {
		$message = $layouts;
	}


	// Print out layout names
	foreach ($layouts as $layout) {
		$rec = $fm->getRecordById($layout, 22);
		if (FileMaker::isError($rec)) {
			$status = false;
		    $message = sprintf("Error %s: %s", $layouts->getCode(), $layouts->getMessage());
		} else {

			$message []= array_reduce($rec->getFields(), function ($carry, $field) use ($rec) {
				$carry[$field] = $rec->getField($field);
				return $carry;
			}, []);
		}
	    echo $layout;
	}

	return ['status' => $status, 'message' => $message];
});