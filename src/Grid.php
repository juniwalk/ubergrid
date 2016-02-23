<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid;

class Grid extends \Nette\Application\UI\Control
{


	public function render()
	{
		$template = $this->createTemplate();
		$template->setFile(__DIR__.'/templates/grid.latte');
		$template->render();
	}


	/**
	 * @param  string  $name
	 * @return Components\Table
	 */
	protected function createComponentTable($name)
	{
		return new Components\Table;
	}


	/**
	 * @param  string  $name
	 * @return Components\Paginator
	 */
	protected function createComponentPaginator($name)
	{
		return new Components\Paginator;
	}


	/**
	 * @param  string  $name
	 * @return Components\PerPage
	 */
	protected function createComponentPerPage($name)
	{
		return new Components\PerPage;
	}
}

interface IGridFactory
{
	/**
	 * @return Grid
	 */
	public function create();
}
