<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid\Filter;

use JuniWalk\Ubergrid\Tools;
use Nette\ComponentModel\Component;
use Nette\Application\UI\Form;

abstract class AbstractFilter extends Component implements Filter
{
	use Tools\Attributes;
	use Tools\Callback;
	use Tools\Title;


	/**
	 * @param string  $name
	 * @param string|NULL  $title
	 */
	public function __construct(string $name, string $title = NULL)
	{
		parent::__construct(NULL, $name);
		$this->title = $title;
	}


	/**
	 * @param Form  $form
	 */
	abstract public function createInput(Form $form);
}
