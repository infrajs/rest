<?php

namespace infrajs\rest;

use infrajs\path\Path;
use infrajs\view\View;
use infrajs\sequence\Sequence;
use infrajs\template\Template;
use infrajs\cache\CacheOnce;

class Rest
{
	public static $name = 'rest';
	use CacheOnce;
	public static function parse($tpl, $data = array(), $root = 'root')
	{
		$data['query'] = Rest::getQuery();
		$data['root'] = Rest::getRoot();
		$crumbs = Sequence::right($data['query'], '/');

		$data['crumbs'] = array();
		$href = $data['root'];
		foreach ($crumbs as $c) {
			$href .= '/';
			$href .= $c;
			$data['crumbs'][] = array(
				'href' => $href,
				'title' => $c
			);
		};
		array_unshift($data['crumbs'], array('href' => $data['root'], "title" => $data['root']));
		$data['crumbs'][sizeof($data['crumbs']) - 1]['active'] = true;

		$page = Template::parse('-rest/index.tpl', $data, 'page');
		View::html($page, true);

		$html = Template::parse($tpl, $data, $root);
		View::html($html, 'page');
		return View::html();
	}
	// public static $once = array();
	public static function request()
	{
		$query = urldecode($_SERVER['REQUEST_URI']);

		$key = $query;
		if (isset(static::$once[$key])) return static::$once[$key];


		$path = $query;
		$path = preg_replace('/^\//', '', $path);
		$p = explode('?', $path, 2);
		$path = $p[0];

		$p = explode('/', $path);

		foreach ($p as $k => $v) {
			if (strlen($v) == 0) unset($p[$k]);
		}
		$dir = implode('/', $p);
		$path = $dir;


		while (!Path::theme($dir . '/index.php') && sizeof($p) > 1) {
			array_pop($p);
			$dir = implode('/', $p);
		}
		$root = implode('/', $p);
		$query = substr($path, strlen($dir));
		$query = preg_replace('/^\/*/', '', $query);

		return static::$once[$key] = ['query' => $query, 'root' => $root];
	}
	public static function getQuery()
	{
		$res = Rest::request();
		return $res['query'];
	}
	public static function getRoot()
	{
		$res = Rest::request();
		return $res['root'];
	}
	public static function meta() {
		$res = Rest::request();
		$data = static::once('meta', $res['root'], function ($root) {
			$root = Path::theme($root.'/');
			$json = file_get_contents($root.'meta.json');
			$data = json_decode($json, true);
			return $data;
		});
		return $data;
	}
	
	public static function first()
	{
		$rest = Rest::getQuery() . '/';
		$rest = Sequence::right($rest, '/');
		if (isset($rest[0])) return $rest[0];
		else return '';
	}
	public static function second()
	{
		$rest = Rest::getQuery() . '/';
		$rest = Sequence::right($rest, '/');
		if (isset($rest[1])) return $rest[1];
		else return '';
	}
	public static function third()
	{
		$rest = Rest::getQuery() . '/';
		$rest = Sequence::right($rest, '/');
		if (isset($rest[2])) return $rest[2];
		else return '';
	}
	public static function get($values)
	{
		if (!is_array($values)) $values = func_get_args();
		$rest = Rest::getQuery() . '/';
		$rest = Sequence::right($rest, '/');
		return Rest::_get($values, $rest);
	}
	public static function _get($values, $rest = [])
	{
		$query = Rest::getQuery();
		$right = Sequence::right($query, '/');
		$len = sizeof($values);
		if (!($len % 2)) { //Чётное и в конце массив для любого значения
			$root = array_shift($values);
			$inner = array_pop($values);
			$values = array_reverse($values);
			array_push($values, $inner);
			array_push($values, false);  //-
			array_push($values, $root);
			array_push($values, true);	//-/-
		} else {

			$root = array_shift($values);
			$values = array_reverse($values);
			array_push($values, $root);
			array_push($values, true);
		}
		$ar = array_chunk($values, 2);

		foreach ($ar as $obj) {
			$val = $obj[0];
			$key = $obj[1];
			$r = null;

			$exec = $key === true || (isset($rest[0]) && $key === false) || (isset($rest[0]) && $key === $rest[0]);

			if (!$exec) continue;

			if (is_array($val)) {
				array_shift($rest);
				return Rest::_get($val, $rest);
			} else {
				return call_user_func_array($val, $right);
			}
		}
	}
}
