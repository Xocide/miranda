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
	private static $output;
	private static $ob_level = 0;
	
	public static function view($view,$return = false)
	{
		$view = strtolower($view);
		if(!file_exists(APPPATH.'views/'.$view.'.php'))
		{
			ob_end_clean();
			die('Error loading view: '.$view);
		}
		
		ob_start();
		include(APPPATH.'views/'.$view.'.php');
		
		// Return the file data if requested
		if($return)
		{		
			$buffer = ob_get_contents();
			@ob_end_clean();
			return $buffer;
		}
		
		if(ob_get_level() > self::$ob_level + 1)
		{
			ob_end_flush();
		}
		else
		{
			self::$output .= ob_get_contents();
			@ob_end_clean();
		}
	}
	
	public static function display()
	{
		echo self::$output;
	}
}