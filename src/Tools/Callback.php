<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid\Tools;

trait Callback
{
	/**
	 * @var callable|NULL
	 */
	private $callback;


	/**
	 * @param  callable|NULL  $callback
	 * @return static
	 */
	public function setCallback(callable $callback = NULL) : self
	{
		$this->callback = $callback;
		return $this;
	}


	/**
	 * @return callable|NULL
	 */
	public function getCallback()
	{
		return $this->callback;
	}
}
