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

/**
 * Prints a nice little error message.
 *
 * @param string $message The error message.
 */
function error($message)
{
	ob_end_flush();
	print('<blockquote style="width: 800px; margin: 0 auto; font-family: arial; font-size: 14px;">');
	print('<h1 style="margin:0;">Error</h1>');
	print('<div style="padding: 5px; border: 2px solid darkred; background: #f9f9f9;">'.$message.'</div>');
	print('<small>Miranda '.\Miranda\VERSION);
	print('</blockquote>');
	exit;
}