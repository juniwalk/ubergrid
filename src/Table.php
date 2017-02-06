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
use JuniWalk\Ubergrid\Filter\Filter;
use Nette\ComponentModel\Container;

/**
 * @property array $data
 */
class Table extends \Nette\Application\UI\Control
{
	/**
	 * @var array
	 */
	private $data;


	/**
	 * @param Column  $column
	 */
	public function addColumn(Column $column) : Column
	{
		$this->getComponent('columns')->addComponent($column, NULL);
		return $column;
	}


	/**
	 * @return Column[]
	 */
	public function getColumns() : \Traversable
	{
		return $this->getComponent('columns')->getComponents(Column::class);
	}


	/**
	 * @param Filter  $filter
	 */
	public function addFilter(Filter $filter) : Filter
	{
		$this->getComponent('filters')->addComponent($filter, NULL);
		return $filter;
	}


	/**
	 * @return Filter[]
	 */
	public function getFilters() : \Traversable
	{
		return $this->getComponent('filters')->getComponents(Filter::class);
	}


	/**
	 * @param array  $data
	 */
	public function setData(array $data)
	{
		$this->data = $data;
	}


	/**
	 * @return array
	 */
	public function getData() : array
	{
		return $this->data;
	}


	public function render()
	{
		$template = $this->createTemplate();
		$template->setFile(__DIR__.'/templates/table.latte');
		$template->add('columns', $this->getColumns());
		$template->add('items', $this->getData());
		$template->render();
	}


	/**
	 * @param  string  $name
	 * @return Container
	 */
	protected function createComponentColumns(string $name) : Container
	{
		return new Container($this, $name);
	}


	/**
	 * @param  string  $name
	 * @return Container
	 */
	protected function createComponentFilters(string $name) : Container
	{
		return new Container($this, $name);
	}
}
