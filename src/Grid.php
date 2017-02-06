<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid;

use JuniWalk\Ubergrid\Source\SourceFactory;
use JuniWalk\Ubergrid\Source\Source;
use JuniWalk\Ubergrid\Column;
use JuniWalk\Ubergrid\Filter;
use Nette\Application\UI\Form;
use Nette\ComponentModel\Container;

class Grid extends \Nette\Application\UI\Control
{
	/**
	 * @var Source
	 */
	private $source;


	/**
	 * @param  mixed  $data
	 * @return Source
	 */
	public function createSource($data) : Source
	{
		return $this->source = (new SourceFactory)->create($data);
	}


	/**
	 * @param Source  $source
	 */
	public function setSource(Source $source)
	{
		$this->source = $source;
	}


	/**
	 * @return Source
	 */
	public function getSource() : Source
	{
		return $this->source;
	}


	/**
	 * @param  string  $name
	 * @param  string|NULL  $title
	 * @return Column\Column
	 */
	public function addColumnText(string $name, string $title = NULL) : Column\Column
	{
		return $this->getComponent('table')->addColumn(new Column\TextColumn($name, $title));
	}


	/**
	 * @param  string  $name
	 * @param  string|NULL  $title
	 * @return Filter\Filter
	 */
	public function addFilterText(string $name, string $title = NULL) : Filter\Filter
	{
		return $this->getComponent('table')->addFilter(new Filter\TextFilter($name, $title));
	}


	public function render()
	{
		$paginator = $this->getComponent('paginator');
		$table = $this->getComponent('table');
		$source = $this->getSource();

		// TODO: Move this to the paginator method
		if ($perPage = $paginator->getPerPage()) {
			$offset = ($paginator->getPage() - 1) * $perPage;
			$paginator->pages = ceil($source->getCount() / $perPage);

			$source->limit($offset, $perPage);
		}

		$items = [];

		foreach ($source->getData() as $item) {
			$items[] = new Row($item);
		}

		$table->setData($items);

		$template = $this->createTemplate();
		$template->setFile(__DIR__.'/templates/grid.latte');
		$template->render();
	}


	/**
	 * @param  string  $name
	 * @return Form
	 */
	protected function createComponentOuterFilter(string $name) : Form
	{
		$form = new Form($this, $name);
		$form->addText('column');
		$form->addSubmit('submit');

		$form->onSuccess[] = function ($form, $data) {

		};

		return $form;
	}


	/**
	 * @param  string  $name
	 * @return Table
	 */
	protected function createComponentTable(string $name) : Table
	{
		return new Table($this, $name);
	}


	/**
	 * @param  string  $name
	 * @return Paginator
	 */
	protected function createComponentPaginator(string $name) : Paginator
	{
		return new Paginator($this, $name);
	}
}
