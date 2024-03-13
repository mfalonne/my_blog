<?php

// Definition of the namespace (namespace) App
namespace App\Router;

// Declaration of the Router class within the App namespace
class Router {

    // Private property to store the URL
    private $url;

    // Private Property to store an array of routes
    private $routes = [];

    // Constructor of the class, called during the instantiation of the object
    public function __construct($url){

        // Initialization of the private property $url with the value provided as a parameter
        $this->url = $url;
    }

    // Public method to add a GET route
    public function get($path,$callable){

        // Creating a new Route instance with the provided path and callable
        $route = new Route($path,$callable);

         // Adding the route to the array of routes for the 'GET' method
        $this->routes['GET'][] = $route;
    }
    // Public method to add a POST route
    public function post($path,$callable){

        // Creating a new Route instance with the provided path and callable
        $route = new Route($path,$callable);

         // Adding the route to the array of routes for the 'POST' method
        $this->routes['POST'][] = $route;
    }

    // Public method to run the router and match the requested URL to defined routes
    public function run(){

        // Check if the requested HTTP method exists in the defined routes
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouterException('REQUEST_METHOD does not exist');
        }

        // Iterate through routes for the requested HTTP method
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){

            // Check if the route matches the current URL
            if($route->match($this->url)){

                // Si une correspondance est trouvée, exécuter la fonction de rappel associée et retourner le résultat
                return $route->call();
            }
        }

        // If no matching route is found, throw an exception
        throw new RouterException('No matching routes');
    }

}