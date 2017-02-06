<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid;

use JuniWalk\Ubergrid\Column\Column;
use Nette\Utils\Html;

final class Row
{
	/**
	 * @var mixed
	 */
	private $item;


	/**
	 * @param mixed  $item
	 */
	public function __construct($item)
	{
		$this->item = $item;
	}


	/**
	 * @return mixed
	 */
	public function getId()
	{
		// TODO: We need to globalize this, handle it through Source like ublaboo\datagrid?
		return $this->item->id;
	}


	/**
	 * @param  Column  $column
	 * @return Html
	 */
	public function render(Column $column) : Html
	{
		// TODO: Use PropertyAccessor to get value
		$text = $this->item->{$column->getName()};

		if ($callback = $column->getCallback()) {
			$text = $callback($this->item);
		}

		if ($text instanceof Html && $text->getName() == 'td') {
			return $text;
		}

		return Html::el('td')->setHtml($text)
			->addAttributes($column->getAttributes());
	}
}
