<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid\Tools;

trait Title
{
	/**
	 * @var string|NULL
	 */
	private $title;


	/**
	 * @param  string|NULL  $title
	 * @return static
	 */
	public function setTitle(string $title = NULL) : self
	{
		$this->title = $title;
		return $this;
	}


	/**
	 * @return string|NULL
	 */
	public function getTitle()
	{
		return $this->title;
	}
}
