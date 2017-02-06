<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid\Column;

use Nette\Utils\Html;

interface Column
{
	/**
	 * @param string  $name
	 * @param string|NULL  $title
	 */
	public function __construct(string $name, string $title = NULL);


	/**
	 * @return Html
	 */
	public function createHeader() : Html;
}
