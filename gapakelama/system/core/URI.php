<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2018, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2018, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * URI Class
 *
 * Parses URIs and determines routing
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	URI
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/libraries/uri.html
 */
class CI_URI {

	/**
	 * List of cached URI segments
	 *
	 * @var	array
	 */
	public $keyval = array();

	/**
	 * Current URI string
	 *
	 * @var	string
	 */
	public $uri_string = '';

	/**
	 * List of URI segments
	 *
	 * Starts at 1 instead of 0.
	 *
	 * @var	array
	 */
	public $segments = array();

	/**
	 * List of routed URI segments
	 *
	 * Starts at 1 instead of 0.
	 *
	 * @var	array
	 */
	public $rsegments = array();

	/**
	 * Permitted URI chars
	 *
	 * PCRE character group allowed in URI segments
	 *
	 * @var	string
	 */
	protected $_permitted_uri_chars;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		$this->config =& load_class('Config', 'core');

		// If query strings are enabled, we don't need to parse any segments.
		// However, they don't make sense under CLI.
		if (is_cli() OR $this->config->item('enable_query_strings') !== TRUE)
		{
			$this->_permitted_uri_chars = $this->config->item('permitted_uri_chars');

			// If it's a CLI request, ignore the configuration
			if (is_cli())
			{
				$uri = $this->_parse_argv();
			}
			else
			{
				$protocol = $this->config->item('uri_protocol');
				empty($protocol) && $protocol = 'REQUEST_URI';

				switch ($protocol)
				{
					case 'AUTO': // For BC purposes only
					case 'REQUEST_URI':
						$uri = $this->_parse_request_uri();
						break;
					case 'QUERY_STRING':
						$uri = $this->_parse_query_string();
						break;
					case 'PATH_INFO':
					default:
						$uri = isset($_SERVER[$protocol])
							? $_SERVER[$protocol]
							: $this->_parse_request_uri();
						break;
				}
			}

			$this->_set_uri_string($uri);
		}

		log_message('info', 'URI Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Set URI String
	 *
	 * @param 	string	$str
	 * @return	void
	 */
	protected function _set_uri_string($str)
	{
		// Filter out control characters and trim slashes
		$this->uri_string = trim(remove_invisible_characters($str, FALSE), '/');

		if ($this->uri_string !== '')
		{
			// Remove the URL suffix, if present
			if (($suffix = (string) $this->config->item('url_suffix')) !== '')
			{
				$slen = strlen($suffix);

				if (substr($this->uri_string, -$slen) === $suffix)
				{
					$this->uri_string = substr($this->uri_string, 0, -$slen);
				}
			}

			$this->segments[0] = NULL;
			// Populate the segments array
			foreach (explode('/', trim($this->uri_string, '/')) as $val)
			{
				$val = trim($val);
				// Filter segments for security
				$this->filter_uri($val);

				if ($val !== '')
				{
					$this->segments[] = $val;
				}
			}

			unset($this->segments[0]);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Parse REQUEST_URI
	 *
	 * Will parse REQUEST_URI and automatically detect the URI from it,
	 * while fixing the query string if necessary.
	 *
	 * @return	string
	 */
	protected function _parse_request_uri()
	{
		if ( ! isset($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']))
		{
			return '';
		}

		// parse_url() returns false if no host is present, but the path or query string
		// contains a colon followed by a number
		$uri = parse_url('http://dummy'.$_SERVER['REQUEST_URI']);
		$query = isset($uri['query']) ? $uri['query'] : '';
		$uri = isset($uri['path']) ? $uri['path'] : '';

		if (isset($_SERVER['SCRIPT_NAME'][0]))
		{
			if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0)
			{
				$uri = (string) substr($uri, strlen($_SERVER['SCRIPT_NAME']));
			}
			elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0)
			{
				$uri = (string) substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
			}
		}

		// This section ensures that even on servers that require the URI to be in the query string (Nginx) a correct
		// URI is found, and also fixes the QUERY_STRING server var and $_GET array.
		if (trim($uri, '/') === '' && strncmp($query, '/', 1) === 0)
		{
			$query = explode('?', $query, 2);
			$uri = $query[0];
			$_SERVER['QUERY_STRING'] = isset($query[1]) ? $query[1] : '';
		}
		else
		{
			$_SERVER['QUERY_STRING'] = $query;
		}

		parse_str($_SERVER['QUERY_STRING'], $_GET);

		if ($uri === '/' OR $uri === '')
		{
			return '/';
		}

		// Do some final cleaning of the URI and return it
		return $this->_remove_relative_directory($uri);
	}

	// --------------------------------------------------------------------

	/**
	 * Parse QUERY_STRING
	 *
	 * Will parse QUERY_STRING and automatically detect the URI from it.
	 *
	 * @return	string
	 */
	protected function _parse_query_string()
	{
		$uri = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : @getenv('QUERY_STRING');

		if (trim($uri, '/') === '')
		{
			return '';
		}
		elseif (strncmp($uri, '/', 1) === 0)
		{
			$uri = explode('?', $uri, 2);
			$_SERVER['QUERY_STRING'] = isset($uri[1]) ? $uri[1] : '';
			$uri = $uri[0];
		}

		parse_str($_SERVER['QUERY_STRING'], $_GET);

		return $this->_remove_relative_directory($uri);
	}

	// --------------------------------------------------------------------

	/**
	 * Parse CLI arguments
	 *
	 * Take each command line argument and assume it is a URI segment.
	 *
	 * @return	string
	 */
	protected function _parse_argv()
	{
		$args = array_slice($_SERVER['argv'], 1);
		return $args ? implode('/', $args) : '';
	}

	// --------------------------------------------------------------------

	/**
	 * Remove relative directory (../) and multi slashes (///)
	 *
	 * Do some final cleaning of the URI and return it, currently only used in self::_parse_request_uri()
	 *
	 * @param	string	$uri
	 * @return	string
	 */
	protected function _remove_relative_directory($uri)
	{
		$uris = array();
		$tok = strtok($uri, '/');
		while ($tok !== FALSE)
		{
			if (( ! empty($tok) OR $tok === '0') && $tok !== '..')
			{
				$uris[] = $tok;
			}
			$tok = strtok('/');
		}

		return implode('/', $uris);
	}

	// --------------------------------------------------------------------

	/**
	 * Filter URI
	 *
	 * Filters segments for malicious characters.
	 *
	 * @param	string	$str
	 * @return	void
	 */
	public function filter_uri(&$str)
	{
		if ( ! empty($str) && ! empty($this->_permitted_uri_chars) && ! preg_match('/^['.$this->_permitted_uri_chars.']+$/i'.(UTF8_ENABLED ? 'u' : ''), $str))
		{
			show_error('The URI you submitted has disallowed characters.', 400);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch URI Segment
	 *
	 * @see		CI_URI::$segments
	 * @param	int		$n		Index
	 * @param	mixed		$no_result	What to return if the segment index is not found
	 * @return	mixed
	 */
	public function segment($n, $no_result = NULL)
	{
		return isset($this->segments[$n]) ? $this->segments[$n] : $no_result;
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch URI "routed" Segment
	 *
	 * Returns the re-routed URI segment (assuming routing rules are used)
	 * based on the index provided. If there is no routing, will return
	 * the same result as CI_URI::segment().
	 *
	 * @see		CI_URI::$rsegments
	 * @see		CI_URI::segment()
	 * @param	int		$n		Index
	 * @param	mixed		$no_result	What to return if the segment index is not found
	 * @return	mixed
	 */
	public function rsegment($n, $no_result = NULL)
	{
		return isset($this->rsegments[$n]) ? $this->rsegments[$n] : $no_result;
	}

	// --------------------------------------------------------------------

	/**
	 * URI to assoc
	 *
	 * Generates an associative array of URI data starting at the supplied
	 * segment index. For example, if this is your URI:
	 *
	 *	example.com/user/search/name/joe/location/UK/gender/male
	 *
	 * You can use this method to generate an array with this prototype:
	 *
	 *	array (
	 *		name => joe
	 *		location => UK
	 *		gender => male
	 *	 )
	 *
	 * @param	int	$n		Index (default: 3)
	 * @param	array	$default	Default values
	 * @return	array
	 */
	public function uri_to_assoc($n = 3, $default = array())
	{
		return $this->_uri_to_assoc($n, $default, 'segment');
	}

	// --------------------------------------------------------------------

	/**
	 * Routed URI to assoc
	 *
	 * Identical to CI_URI::uri_to_assoc(), only it uses the re-routed
	 * segment array.
	 *
	 * @see		CI_URI::uri_to_assoc()
	 * @param 	int	$n		Index (default: 3)
	 * @param 	array	$default	Default values
	 * @return 	array
	 */
	public function ruri_to_assoc($n = 3, $default = array())
	{
		return $this->_uri_to_assoc($n, $default, 'rsegment');
	}

	// --------------------------------------------------------------------

	/**
	 * Internal URI-to-assoc
	 *
	 * Generates a key/value pair from the URI string or re-routed URI string.
	 *
	 * @used-by	CI_URI::uri_to_assoc()
	 * @used-by	CI_URI::ruri_to_assoc()
	 * @param	int	$n		Index (default: 3)
	 * @param	array	$default	Default values
	 * @param	string	$which		Array name ('segment' or 'rsegment')
	 * @return	array
	 */
	protected function _uri_to_assoc($n = 3, $default = array(), $which = 'segment')
	{
		if ( ! is_numeric($n))
		{
			return $default;
		}

		if (isset($this->keyval[$which], $this->keyval[$which][$n]))
		{
			return $this->keyval[$which][$n];
		}

		$total_segments = "total_{$which}s";
		$segment_array = "{$which}_array";

		if ($this->$total_segments() < $n)
		{
			return (count($default) === 0)
				? array()
				: array_fill_keys($default, NULL);
		}

		$segments = array_slice($this->$segment_array(), ($n - 1));
		$i = 0;
		$lastval = '';
		$retval = array();
		foreach ($segments as $seg)
		{
			if ($i % 2)
			{
				$retval[$lastval] = $seg;
			}
			else
			{
				$retval[$seg] = NULL;
				$lastval = $seg;
			}

			$i++;
		}

		if (count($default) > 0)
		{
			foreach ($default as $val)
			{
				if ( ! array_key_exists($val, $retval))
				{
					$retval[$val] = NULL;
				}
			}
		}

		// Cache the array for reuse
		isset($this->keyval[$which]) OR $this->keyval[$which] = array();
		$this->keyval[$which][$n] = $retval;
		return $retval;
	}

	// --------------------------------------------------------------------

	/**
	 * Assoc to URI
	 *
	 * Generates a URI string from an associative array.
	 *
	 * @param	array	$array	Input array of key/value pairs
	 * @return	string	URI string
	 */
	public function assoc_to_uri($array)
	{
		$temp = array();
		foreach ((array) $array as $key => $valINDX( 	 �ON          (   0  �       e p                   +0    � �     �    ���?�����?���������q����       m         o   A l a r m s A p p L i s t . t a r g e t s i z e - 4 8 . p n g �0    � �     �    &K��?��&K��?��������\�����       m         o  0 A l a r m s A p p L i s t . t a r g e t s i z e - 4 8 _ a l t f o r m - u n p l a t e d . p n g ��?���3    � �     �    �/��?��Hy��?��������������       |         o   A l a r m s A p p L i s t . t a r g  t s i z e - 6 0 . p n g �3    � �     �    �/��?��Hy��?��������������       |         o  0 A l a r m s A p p L i s t . t a r g e t s i z e - 6 0 _ a l t f o r m - u n p l a t e d . p n g ��?��`.    � �     �    5;��?��5;��?���������G-����       �         o   A l a r m s A p p L i s t . t a r g e t s i z e - 6 4 . p n g `.    � �     �    5;��?��5;��?���������G-����       �         o  0 A l a r m s A p p L i s t . t a r g e t s i z e - 6 4 _ a l t f o r m - u n  l a t e d . p n g ��?��Y�    � �     �    �䢣?���䢣?��������T2����       �         o   A l a r m s A p p L i s t . t a r g e t s i z e - 7 2 . p n g Y�    � �     �    �䢣?���䢣?��������T2����       �         o  0 A l a r m s A p p L i s t . t a r g e t s i z e - 7 2 _ a l t f o r m - u n p l a t e d . p n g ��?����   
 � �     �    C|��?��C|��?��������
�6����                 o   A l a r m s A p p L i s t . t a r g e t s i z e - 8 0 . p n g ��   
 � �    �    C|��?��C|��?��������
�6����                 o  0 A l a r m s A p p L i s t . t a r g e t s i z e - 8 0 _ a l t f o r m - u n p l a t e d . p n g ��?��hx    � �     �    ����?��)��?��������8�;����                o   A l a r m s A p p L i s t . t a r g e t s i z e - 9 6 . p n g                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     