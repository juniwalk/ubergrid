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
		$table = new Components\Table($this, $name);
		$table->setData(json_decode(file_get_contents(__DIR__.'/data.json')));

		return $table;
	}


	/**
	 * @param  string  $name
	 * @return Components\Paginator
	 */
	protected function createComponentPaginator($name)
	{
		return new Components\Paginator($this, $name);
	}


	/**
	 * @param  string  $name
	 * @return Components\PerPage
	 */
	protected function createComponentPerPage($name)
	{
		return new Components\PerPage($this, $name);
	}
}
