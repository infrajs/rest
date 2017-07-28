<?php
namespace infrajs\rest;
use infrajs\ans\Ans;
use infrajs\path\Path;
use infrajs\once\Once;
use infrajs\sequence\Sequence;

class Rest {
	public static function parse() 
	{
		return Once::exec(__FILE__, function ($query) {		
			$path = $query;
			$path = preg_replace('/^\//', '', $path);
			$p = explode('?', $path, 2);
			$path = $p[0];
			
			$p = explode('/', $path);
			$dir = implode('/', $p);

			do {
				array_pop($p);
				$dir = implode('/', $p).'/';
			} while (!Path::theme($dir.'index.php') && sizeof($p) > 2);

			$rest = str_replace($dir, '', $path);
			
			return $rest;
		}, array($_SERVER['REQUEST_URI']));
	}
	public static function get ($type = false, $fn = false)
	{
		$rest = Rest::parse();
		$right = Sequence::right($rest, '/');
		$rtype = array_shift($right);
		if ($rtype != $type) return;
		$rest = implode('/', $right);
		array_unshift($right, $rest);
		call_user_func_array($fn, $right);
	}
}