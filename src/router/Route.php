<?php

// Namespace declaration (namespace) App
namespace App\Router;

// Class definition for Route within the App namespace
class Route {
    
    // Private properties to store the path and callable associated with the route
    private $path;
    private $callable;

    // Private property to store matched values from route parameters
    private $matches = [];

    //private $params = [];

    // Constructor method for the Route class
    public function __construct($path, $callable)
    {
        $this->path = trim($path,'/');
        $this->callable = $callable;
    }
    
    public function match($url){

    // Trim leading and trailing slashes from the provided URL
    $url = trim($url,'/');

    // Replace route parameter placeholders with a regular expression pattern
    $path = preg_replace(('#:([\w]+)#'), '([^/]+)', $this->path);

    // Construct a regular expression pattern for matching the URL against the route
    $regex = "#^$path$#i";

    // Check if the provided URL matches the constructed regular expression pattern
    if (!preg_match($regex, $url, $matches)){

        return false;
    }

    // Remove the first element (full match) from the matches array
    array_shift($matches);

    // Store the matched values in the object's matches property
    $this->matches = $matches;

    // Return true to indicate a successful match
    return true;
    }

    public function call(){
        /* Calls the function specified by $this->callable with the arguments contained in $this->matches.
        // Uses the call_user_func_array function to enable dynamic calling with an array of arguments.
        // Returns the result of this call.*/
        return call_user_func_array($this->callable, $this->matches);
    }


}