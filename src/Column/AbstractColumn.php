<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid\Column;

use JuniWalk\Ubergrid\Tools;
use Nette\ComponentModel\Component;
use Nette\Utils\Html;

abstract class AbstractColumn extends Component implements Column
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

		$this->addAttribute('class', 'column-'.$name);
	}


	/**
	 * @return Html
	 */
	public function createHeader() : Html
	{
		$value = $this->title ?: $this->getName();

		return Html::el('th')->setText($value)
			->addAttributes($this->getAttributes());
	}
}
