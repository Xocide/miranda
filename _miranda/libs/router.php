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

namespace Miranda;

class Router
{
	private static $routes = array();
	public static $controller;
	public static $method;
	
	public function __construct()
	{
	}
	
	public static function route()
	{
		if(!isset($_SERVER['PATH_INFO'])) $_SERVER['PATH_INFO'] = '';
		
		// Fetch router config
		require(APPPATH.'config/routes.php');
		self::$routes = array_merge(self::$routes,$routes);
		
		// Get URI segments
		$request = trim($_SERVER['PATH_INFO'],'/');
		
		// Check if we only have one route
		if(count($routes) == 1)
		{
			self::_set_request($request);
			return;
		}
		
		// Loop through the route array looking for wild-cards
		foreach(self::$routes as $key => $val)
		{						
			// Convert wild-cards to RegEx
			$key = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $key));
			
			// Do we have a back-reference?
			if(strpos($val, '$') !== FALSE AND strpos($key, '(') !== FALSE)
				$val = preg_replace('#^'.$key.'$#', $val, $request);
			
			// Check if theres a RegEx match
			if(preg_match('#^'.$key.'$#', $request))
			{
				self::_set_request($val);
				return;
			}
		}

		// No matches found, give it the current uri
		self::_set_request($request);
	}
	
	// Private function used to set the request controller and method.
	private static function _set_request($uri)
	{
		$segs = explode('/',$uri);
		
		if($segs[0] == '')
			$segs = explode('/',self::$routes['root']);
		
		self::$controller = $segs[0];
		if(!isset($segs[1]))
			self::$method = 'index';
		else
			self::$method = $segs[1];
	}
}