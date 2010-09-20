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

namespace Miranda\Database;
use \Sqlite3 as SQlite3;

class SQLite extends SQLite3
{
	private $link;
	public $prefix = '';
	
	public function __construct($config)
	{
		$this->open(APPPATH.$config['file']);
		$this->prefix = (isset($config['prefix']) ? $config['prefix'] :'');
	}
	
	/**
	 * Fetches an array of the specified query result.
	 *
	 * @param resource $res The query result.
	 */
	public function fetch_array($res)
	{
		return $res->fetchArray();
	}
	
	/**
	 * Returns the ID of the last inserted row.
	 * @return integer
	 */
	public function insert_id()
	{
		return $this->lastInsertRowID();
	}
	
	/**
	 * Escapes a string for use in a query.
	 *
	 * @param string $string String to escape.
	 * @return string
	 */
	public function escape_string($string)
	{
		return $this->escapeString($string);
	}
	
	/**
	 * Escape script shortcut.
	 *
	 * @param string $string String to escape.
	 * @return string
	 */
	public function es($string)
	{
		return $this->escapeString($string);
	}
	
	/**
	 * Easy SELECT query builder.
	 *
	 * @param string $table Table name to query
	 * @param array $args Arguments for the query
	 * @return array
	 */
	public function select($table,$args=array())
	{
		$query = 'SELECT * FROM '.$this->prefix.$table.' ';
		
		$orderby = (isset($args['orderby']) ? " ORDER BY ".$args['orderby'] : NULL);
		unset($args['orderby']);
		
		$limit = (isset($args['limit']) ? ' LIMIT '.$args['limit'] : NULL);
		unset($args['limit']);
		
		if(isset($args['where']) && is_array($args['where'])) {
			$fields = array();
			foreach($args['where'] as $field => $value)
			{
				$fields[] = $field."='".$value."'";
			}
			$fields = ' WHERE '.implode(' AND ',$fields);
		} else {
			$fields = (isset($args['where']) ? $args['where'] : '');
		}
		
		$query .= $fields;
		$query .= $orderby;
		$query .= $limit;
		
		if(isset($this->results[md5($query)])) return $this->results[md5($query)];
		
		$rows = array();
		$result = $this->query($query);
		while($row = $this->fetch_array($result))
			$rows[] = $row;
		
		$this->results[md5($query)] = $rows;
		
		return $rows;
	}
}