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

const VERSION = "0.1";

class Miranda
{
	/**
	 * Layout filename to use.
	 */
	public $_layout = 'default';
	
	/**
	 * Variables for the views.
	 */
	public $_vars = array();
	
	// Flash message
	private $_flash = NULL;
	
	public function __construct()
	{
		global $render,$db;
		
		// Get the flash message
		if(isset($_SESSION['flash']))
		{
			$this->_flash = $_SESSION['flash'];
			unset($_SESSION['flash']);
		}
		
		// Get the core classes
		$this->db = $db;
		$this->render = $render;
		$this->load = new Loader;
		
		// Load some core helpers
		$this->load->helper('html');
		$this->load->helper('form');
	}
	
	/**
	 * Set a variable accessible from the views.
	 *
	 * @param string $var The variable name.
	 * @param mixed $val The value.
	 */
	public function set($var,$val)
	{
		$this->_vars[$var] = $val;
	}
	
	/**
	 * Set or get the flash message.
	 *
	 * @param string $message The message to set.
	 */
	public function flash($message='')
	{
		if(empty($message))
			return $this->_flash;
		else
			$_SESSION['flash'] = $message;
	}
}