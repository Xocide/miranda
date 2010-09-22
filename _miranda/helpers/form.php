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

class Form
{
	public static function text($name,$args=array())
	{
		return self::input('text',$name,$args);
	}
	
	public static function password($name,$args=array())
	{
		return self::input('password',$name,$args);
	}
	
	public static function hidden($name,$value)
	{
		return self::input('hidden',$name,array('value'=>$value));
	}
	
	public static function submit($text,$name='submit')
	{
		return self::input('submit',$name,array('value'=>$text));
	}
	
	public static function input($type,$name,$args)
	{
		if(isset($args['value']))
			$value = $args['value'];
		elseif(isset($_POST[$name]))
			$value = $_POST[$name];
		else
			$value = '';
		
		if($type == 'text'
		or $type == 'password'
		or $type == 'hidden')
		{
			return '<input type="'.$type.'" name="'.$name.'" value="'.$value.'" />';
		}
		elseif($type == 'submit')
		{
			return '<input type="'.$type.'" value="'.$value.'" />';
		}
	}
}