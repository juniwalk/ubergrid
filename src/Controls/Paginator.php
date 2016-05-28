<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid\Components;

class Paginator extends \Nette\Application\UI\Control
{
	/** @var int @persistent */
	public $page = 1;

	/** @var int */
	private $pages = 0;


	/**
	 * @param int  $page
	 */
	public function handlePage($page)
	{
		$datagrid = $this->getParent();
		$perPage = $datagrid->getComponent('perPage');
		$table = $datagrid->getComponent('table');

		$this->pages = 0;

		if ($perPage = $perPage->getPerPage()) {
			$this->pages = ceil($table->getCount() / $perPage);
		}

		$this->page = min(max($page, 1), $this->pages);

		if (!$this->getPresenter()->isAjax()) {
			$this->redirect('this');
		}

		$datagrid->redrawControl('paginator');
		$datagrid->redrawControl('table');
	}


	/**
	 * @param int  $page
	 */
	public function setPage($page)
	{
		$this->page = $page;
	}


	/**
	 * @return int
	 */
	public function getPage()
	{
		return $this->page;
	}


	/**
	 * @param int  $pages
	 */
	public function setPages($pages)
	{
		$this->pages = $pages;
	}


	/**
	 * @return int
	 */
	public function getPages()
	{
		return $this->pages;
	}


	public function render()
	{
		$template = $this->createTemplate();
		$template->setFile(__DIR__.'/../templates/paginator.latte');
		$template->add('pages', $this->pages);
		$template->add('page', $this->page);
		$template->render();
	}
}
