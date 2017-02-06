<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid\Filter;

use Nette\Application\UI\Form;

interface Filter
{
	/**
	 * @param string  $name
	 * @param string|NULL  $title
	 */
	public function __construct(string $name, string $title = NULL);


	/**
	 * @param Form  $form
	 */
	public function createInput(Form $form);
}
