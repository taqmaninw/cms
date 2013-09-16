<?php

/**
 * Print out debug informations
 * @param mixed $value
 * @return string echoed
 */
function D($value)
{
	echo '<pre>' . print_r($value, true) . '</pre>';
}

/**
 * Print out debug informations for JavaScript
 * @param mixed $value
 * @return string
 */
function DJ($value)
{
	return '<pre>' . print_r($value, true) . '</pre>';
}

/**
 * Get config key
 * @param string $config
 * @param string $key
 * @return string
 */
function CONFIG($config, $key)
{
	if($key == '') return array();

	$conf = Config::get($config);

	return $conf[$key];
}

/**
 * Marker helper
 * @param string $marker Marker code to decode
 * @return string
 */
function MARKER($marker)
{
	return Marker::decode($marker);
}

/**
 * LANG
 */

if ( ! function_exists('t'))
{
	/**
	 * Translate the given message accordingly with active locale.
	 *
	 * @param  string  $id
	 * @param  array   $parameters
	 * @return string
	 */
	function t($id, $parameters = array(), $locale = null)
	{
		$domain = 'messages';
		
		$locale = is_null($locale) ? Config::get('cms::settings.language') : $locale;

		$str = "cms::lang.{$id}";

		return app('translator')->trans($str, $parameters, $domain, $locale);
	}
}

/**
 * SYSTEM
 */

if ( ! function_exists('env'))
{
	/**
	 * Get environment
	 * @param string $env
	 * @return string
	 */
	function env($env)
	{
		return app()->env == $env;
	}
}

if ( ! function_exists('public_path'))
{
	/**
	 * Get public path.
	 *
	 * @return string
	 */
	function public_path($path = '')
	{
		return app()->make('path.public').($path ? '/'.$path : $path);
	}
}

/**
 * TOOLS
 */

if ( ! function_exists('checked'))
{
	/**
	 * Print out checked=checked if true
	 * 
	 * @param  string $var 
	 * @param  string $fix 
	 * @return bool
	 */
	function checked($var, $fix)
	{
		return Tool::isChecked($var, $fix);
	}
}

if ( ! function_exists('link_to_cms'))
{
	/**
	 * Link to cms route
	 * 
	 * @param  string $var 
	 * @param  string $fix 
	 * @return bool
	 */
	function link_to_cms($link, $title, $attributes = array(), $secure = null)
	{
		return link_to('cms/' . $link, $title, $attributes, $secure);
	}
}

if ( ! function_exists('selected'))
{
	/**
	 * Print out selected=selected if true
	 * 
	 * @param  string $var 
	 * @param  string $fix 
	 * @return bool
	 */
	function selected($var, $fix)
	{
		return Tool::isSelected($var, $fix);
	}
}