<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid\Tools;

trait Attributes
{
	/**
	 * @var string[]
	 */
	private $attributes = [];


	/**
	 * @param  string  $name
	 * @param  mixed  $value
	 * @return static
	 */
	public function addAttribute(string $name, $value) : self
	{
		$this->attributes[$name][] = $value;
		return $this;
	}


	/**
	 * @return string[]
	 */
	public function getAttributes() : array
	{
		$implode = function ($value) {
			return implode(' ', $value);
		};

		return array_map($implode, $this->attributes);
	}
}
