<?php
/*
 * This file is part of the Valkyrja framework.
 *
 * (c) Melech Mizrachi
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
|--------------------------------------------------------------------------
| Start Up The Application
|--------------------------------------------------------------------------
|
| TODO: Fill with explanation
|
*/
require_once '../framework/Application.php';

// Set a new global variable for the application!
$app = new \Valkyrja\Application(
    realpath(__DIR__ . '/../')
);

/*
|--------------------------------------------------------------------------
| Application Auto Loader Assemble!
|--------------------------------------------------------------------------
|
| TODO: Fill with explanation
|
*/
// Setup the auto loader for the Application namespace
// - Using our own auto loading for better optimization
$app->autoloader('App\\', $app->appPath());

/*
|--------------------------------------------------------------------------
| Setup The Application With Compiled : A Need For Speed
|--------------------------------------------------------------------------
|
| TODO: Fill with explanation
|
*/
// If there is a compiled version of the application use it!
if (file_exists(__DIR__ . '/../cache/compiled.php')) {
    // Require the compiled file
    require_once __DIR__ . '/../cache/compiled.php';

    // Set the application as using compiled
    $app->setCompiled();
}

/*
|--------------------------------------------------------------------------
| Setup the Application Without Compiled : SlowBro
|--------------------------------------------------------------------------
|
| TODO: Fill with explanation
|
*/
// Otherwise setup environment variables
else {
    /*
    |--------------------------------------------------------------------------
    | Setup The Application Environment Variables
    |--------------------------------------------------------------------------
    |
    | TODO: Fill with explanation
    |
    */
    // Require the environment variables
    $env = require_once __DIR__ . '/../config/env.php';
    // Set the environment variables
    $app->setEnvs($env);

    /*
    |----------------------------------------------------------------------
    | Help An Application Out, Will Ya?
    |----------------------------------------------------------------------
    |
    | TODO: Fill with explanation
    |
    */
    require_once __DIR__ . '/../framework/helpers.php';

    /*
    |----------------------------------------------------------------------
    | Setup The Application Service Container : Dependency Injection
    |----------------------------------------------------------------------
    |
    | TODO: Fill with explanation
    |
    */
    // Require any dependency injectable definitions
    $container = require_once __DIR__ . '/../config/container.php';
    // Set the container variables
    $app->setServiceContainer($container);

    /*
    |----------------------------------------------------------------------
    | Setup The Application Routes
    |----------------------------------------------------------------------
    |
    | TODO: Fill with explanation
    |
    */
    // Require the routes
    $routes = require_once __DIR__ . '/../config/routes.php';
}

// Set the timezone for the application process
$app->setTimezone();

/*
|--------------------------------------------------------------------------
| Service Providers
|--------------------------------------------------------------------------
|
| TODO: Fill with explanation
|
*/
// If twig is enabled in the app environment vars
// then register the service provider
if ($app->env('views.twig.enabled') === true) {
    $app->register(Valkyrja\Providers\TwigServiceProvider::class);
}

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| TODO: Fill with explanation
|
*/
$app->run();
