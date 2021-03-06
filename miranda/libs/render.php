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

class Render
{
	private $final_output = '';
	private $ob_level;
	
	public function __construct()
	{
		global $uri;
		$this->uri = $uri;
		$this->ob_level = ob_get_level();
	}
	
	/**
	 * Loads a view file
	 *
	 * @param string $view The view file path, without extension.
	 */
	public function view($view)
	{
		global $miranda;
		
		// Make the set variables accessible.
		foreach($miranda->_vars as $var => $val) $$var = $val;
		
		
		
		$view = strtolower($view);
		if(!file_exists(APPPATH.'views/'.$view.'.php'))
		{
			error('Error loading view: '.$view);
		}
		
		ob_start();
		include(APPPATH.'views/'.$view.'.php');
		
		if(ob_get_level() > $this->ob_level + 1)
		{
			ob_end_flush();
		}
		else
		{
			$this->final_output .= ob_get_contents();
			@ob_end_clean();
		}
	}
	
	/**
	 * Renders the page, loaded views and layout.
	 *
	 * @param string $layout The layout to use.
	 */
	public function display($layout='default')
	{
		global $miranda;
		
		// Make the set variables accessible.
		foreach($miranda->_vars as $var => $val) $$var = $val;
		
		$_extra = $miranda->_extra;
		
		$output = $this->final_output;
		
		// Check if layout exists.
		if(!file_exists(APPPATH.'views/layouts/'.$layout.'.php'))
			error('Error loading layout: '.$layout);
		
		ob_start();
		require(APPPATH.'views/layouts/'.$layout.'.php');
		$page = ob_get_contents();
		ob_end_clean();
		
		if(extension_loaded('zlib'))
		{
			if(isset($_SERVER['HTTP_ACCEPT_ENCODING']) and strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false)
			{
				if($_SERVER['HTTP_HOST'] != 'localhost') ob_start('ob_gzhandler');
			}
		}
		
		header("X-Powered-By: Miranda ".\Miranda\VERSION);
		
		$memory = (!function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2).'MB';
		$page = str_replace('{memory_useage}',$memory,$page);
		echo $page;
	}
}