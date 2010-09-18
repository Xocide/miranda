<?php
/**
 * Miranda
 * Copyright (C) 2010 Jack Polgar
 *
 * This file is part of Miranda.
 * 
 * Miranda is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 3 only.
 * 
 * Miranda is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Miranda. If not, see <http://www.gnu.org/licenses/>.
 */

// Setup the core libraries.
use \Miranda\Loader as Load;
use \Miranda\Router as Router;
use \Miranda\Render as Render;
use \Miranda\URI as URI;

// Load the core
require("miranda.php");
require("common.php");

// Load the core classes
require(COREPATH."libs/loader.php");
require(COREPATH."libs/router.php");
require(COREPATH."libs/render.php");
require(COREPATH."libs/uri.php");

// Load the app controller
require(APPPATH."controllers/appcontroller.php");

// Do the routing
Router::route();
$controller = '\App\Controllers\\'.Router::$controller.'Controller'; // Build the controller name with namespace.
$method = Router::$method;

// Load the controller
if(file_exists(APPPATH . 'controllers/'.strtolower(Router::$controller).'.php'))
{
	require(APPPATH . 'controllers/'.strtolower(Router::$controller).'.php');
}
else { die("cant load controller: ".Router::$controller); }

// Check if the method exists...
if(!method_exists($controller,$method)) die("method doesnt exist: ".$method);

// Engage!
$render = new Render;
$uri = new URI;
$miranda = new $controller();
$miranda->$method();

// Render the page
$render->view(isset($miranda->view) ? $miranda->view : Router::$controller.'/'.Router::$method);
$render->display($miranda->layout);