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

class HTML
{
	/**
	 * Returns the code for a link.
	 *
	 * @param string $url The URL.
	 * @param string $label The label.
	 * @param array $options Options for the URL code (class, title, etc).
	 */
	public static function link($url,$label,$options=array())
	{
		return '<a href="'.$url.'"'.(isset($options['class']) ? ' class="'.$options['class'].'"' :'').'>'.$label.'</a>';
	}
	
	/**
	 * Returns the code to include a CSS file.
	 *
	 * @param string $file The path to the CSS file.
	 */
	public static function css_inc_tag($file,$media='screen')
	{
		return '<link href="'.$file.'" media="'.$media.'" rel="stylesheet" type="text/css" />';
	}

	/**
	 * Returns the code to include a JavaScript file.
	 *
	 * @param string $file The path to the JavaScript file.
	 */
	public static function js_inc_tag($file)
	{
		return '<script src="'.$file.'" type="text/javascript"></script>';
	}
}

function anchor($uri='')
{
	global $uri;
	return $uri->anchor(func_get_args());
}