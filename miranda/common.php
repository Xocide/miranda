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

/**
 * Slug it
 * Creates a slug / URI safe string.
 *
 * @param string $text The string to change.
 * @return string
 */
function slugit($text)
{
	$text = strip_tags($text);
	$text = remove_accents($text);
	$text = strtolower($text);
	$text = preg_replace('/&.+?;/', '', $text);
	$text = preg_replace('/[^%a-z0-9 _-]/', '', $text);
	$text = preg_replace('/\s+/', '_', $text);
	$text = preg_replace('|-+|', '-', $text);
	$text = trim($text, '_');
	return $text;
}

/**
 * Time Since
 * @param integer $original Original Timestamp
 * @param integer $detailed Detailed format or not
 * @return string
 */
function timesince($original, $detailed = false)
{
	$now = time(); // Get the time right now...
	
	// Time chunks...
	$chunks = array(
		array(60 * 60 * 24 * 365, 'year', 'years'),
		array(60 * 60 * 24 * 30, 'month', 'months'),
		array(60 * 60 * 24 * 7, 'week', 'weeks'),
		array(60 * 60 * 24, 'day', 'days'),
		array(60 * 60, 'hour', 'hours'),
		array(60, 'minute', 'minutes'),
		array(1, 'second', 'seconds'),
	);
	
	// Get the difference
	$difference = ($now - $original);
	
	// Loop around, get the time since
	for($i = 0, $c = count($chunks); $i < $c; $i++)
	{
		$seconds = $chunks[$i][0];
		$name = $chunks[$i][1];
		$names = $chunks[$i][2];
		if(0 != $count = floor($difference / $seconds)) break;
	}
	
	// Format the time since
	//$since = $count." ".((1 == $count) ? $name : $names);
	$since = l('x_'.((1 == $count) ? $name : $names),$count);
	
	// Get the detailed time since if the detaile variable is true
	if($detailed && $i + 1 < $c)
	{
		$seconds2 = $chunks[$i + 1][0];
		$name2 = $chunks[$i + 1][1];
		$names2 = $chunks[$i + 1][2];
		if(0 != $count2 = floor(($difference - $seconds * $count) / $seconds2))
			$since = l('x_and_x',$since,l('x_'.((1 == $count2) ? $name2 : $names2),$count2));
	}
	
	// Return the time since
	return $since;
}

/**
 * Time From
 * @param integer $original Original Timestamp
 * @param integer $detailed Detailed format or not
 * @return string
 */
function timefrom($original, $detailed = false)
{
	$now = time(); // Get the time right now...
	
	// Time chunks...
	$chunks = array(
		array(60 * 60 * 24 * 365, 'year', 'years'),
		array(60 * 60 * 24 * 30, 'month', 'months'),
		array(60 * 60 * 24 * 7, 'week', 'weeks'),
		array(60 * 60 * 24, 'day', 'days'),
		array(60 * 60, 'hour', 'hours'),
		array(60, 'minute', 'minutes'),
		array(1, 'second', 'seconds'),
	);
	
	// Get the difference
	$difference = ($original - $now);
	
	// Loop around, get the time from
	for($i = 0, $c = count($chunks); $i < $c; $i++)
	{
		$seconds = $chunks[$i][0];
		$name = $chunks[$i][1];
		$names = $chunks[$i][2];
		if(0 != $count = floor($difference / $seconds)) break;
	}
	
	// Format the time from
	$from = l('x_'.((1 == $count) ? $name : $names),$count);
	
	// Get the detailed time from if the detaile variable is true
	if($detailed && $i + 1 < $c)
	{
		$seconds2 = $chunks[$i + 1][0];
		$name2 = $chunks[$i + 1][1];
		$names2 = $chunks[$i + 1][2];
		if(0 != $count2 = floor(($difference - $seconds * $count) / $seconds2))
			$from = l('x_and_x',$from,l('x_'.((1 == $count2) ? $name2 : $names2),$count2));
	}
	
	// Return the time from
	return $from;
}

/**
 * Remove Accents
 * Removes accents from the string.
 *
 * @param string $text The string to remove accents from.
 * @return string
 */
function remove_accents($text)
{
	$from = array(
		'À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í',
		'Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü',
		'Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë',
		'ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û',
		'ü','ý','ÿ','A','a','A','a','A','a','C','c','C','c','C',
		'c','C','c','D','d','Ð','d','E','e','E','e','E','e','E',
		'e','E','e','G','g','G','g','G','g','G','g','H','h','H',
		'h','I','i','I','i','I','i','I','i','I','i','?','?','J',
		'j','K','k','L','l','L','l','L','l','?','?','L','l','N',
		'n','N','n','N','n','?','O','o','O','o','O','o','Œ','œ',
		'R','r','R','r','R','r','S','s','S','s','S','s','Š','š',
		'T','t','T','t','T','t','U','u','U','u','U','u','U','u',
		'U','u','U','u','W','w','Y','y','Ÿ','Z','z','Z','z','Ž',
		'ž','?','ƒ','O','o','U','u','A','a','I','i','O','o','U',
		'u','U','u','U','u','U','u','U','u','?','?','?','?','?','?'
	);
	$to = array(
		'A','A','A','A','A','A','AE','C','E','E','E','E','I','I',
		'I','I','D','N','O','O','O','O','O','O','U','U','U','U',
		'Y','s','a','a','a','a','a','a','ae','c','e','e','e','e',
		'i','i','i','i','n','o','o','o','o','o','o','u','u','u',
		'u','y','y','A','a','A','a','A','a','C','c','C','c','C',
		'c','C','c','D','d','D','d','E','e','E','e','E','e','E',
		'e','E','e','G','g','G','g','G','g','G','g','H','h','H',
		'h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J',
		'j','K','k','L','l','L','l','L','l','L','l','l','l','N',
		'n','N','n','N','n','n','O','o','O','o','O','o','OE','oe',
		'R','r','R','r','R','r','S','s','S','s','S','s','S','s',
		'T','t','T','t','T','t','U','u','U','u','U','u','U','u',
		'U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z',
		'z','s','f','O','o','U','u','A','a','I','i','O','o','U',
		'u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o'
	);
	return str_replace($from,$to,$text);
} 