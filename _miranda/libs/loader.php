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

class Loader
{
	private $models = array();
	
	/**
	 * Loads a helper
	 *
	 * @param string $helper Helper filename.
	 */
	public function helper($helper)
	{
		if(file_exists(APPPATH.'helpers/'.$helper.'.php'))
			include(APPPATH.'helpers/'.$helper.'.php');
		elseif(file_exists(COREPATH.'helpers/'.$helper.'.php'))
			include(COREPATH.'helpers/'.$helper.'.php');
		else
			error("cant load helper: ".$helper);
	}
	
	public function model($name)
	{
		if(file_exists(APPPATH.'models/'.$name.'.php'))
			include(APPPATH.'models/'.$name.'.php');
		else
			error("cant load model: ".$name);
		
		$model = $name.'Model';
		$this->models[$name] = new $model;
		
		return $this->models[$name];
	}
}