<?php

// Require the Composer autoload file to enable autoloading of classes
require 'vendor/autoload.php';

use App\Router\Router;

//die($_GET['url']);//display url

// Create a new instance of the Router class with the provided URL from $_GET
$router = new Router($_GET['url']);

$router->get('/', function(){echo 'Homepage';});
$router->get('/posts', function(){echo 'tous les articles';});
$router->get('/posts/:id', function($id){echo 'Afficher l\'article'.$id ;});
$router->post('/posts/:id', function(){echo 'poster l`\'article'.$id;});

// Execute the router to match the requested URL to the defined routes and run the associated callback
$router->run();