<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid;

/**
 * @property int $perPages
 * @property int $pages
 */
class Paginator extends \Nette\Application\UI\Control
{
	/**
	 * @var int
	 * @persistent
	 */
	public $perPage = 10;

	/**
	 * @var int
	 * @persistent
	 */
	public $page = 1;

	/**
	 * @var int[]
	 */
	private $perPages = [10, 20, 50, 0];

	/**
	 * @var int
	 */
	private $pages = 0;


	/**
	 * @param int  $perPage
	 */
	public function handlePerPage(int $perPage)
	{
		$datagrid = $this->getParent();
		$paginator = $datagrid->getComponent('paginator');

		if (in_array($perPage, $this->perPages)) {
			$this->perPage = $perPage;
			$paginator->handlePage(1);
		}

		$datagrid->redrawControl('perPage');
	}


	/**
	 * @param int  $page
	 */
	public function handlePage(int $page)
	{
		$datagrid = $this->getParent();
		$source = $datagrid->getSource();

		$this->pages = 0;

		if ($perPage = $this->getPerPage()) {
			$this->pages = ceil($source->getCount() / $perPage);
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
	public function setPage(int $page)
	{
		$this->page = $page;
	}


	/**
	 * @param int  $perPage
	 */
	public function setPerPage(int $perPage)
	{
		$this->perPage = $perPage;
	}


	/**
	 * @return int
	 */
	public function getPerPage() : int
	{
		return $this->perPage;
	}


	/**
	 * @param int[]  $perPages
	 */
	public function setPerPages(array $perPages)
	{
		$this->perPages = $perPages;
	}


	/**
	 * @return int[]
	 */
	public function getPerPages() : array
	{
		return $this->perPages;
	}


	/**
	 * @return int
	 */
	public function getPage() : int
	{
		return $this->page;
	}


	/**
	 * @param int  $pages
	 */
	public function setPages(int $pages)
	{
		$this->pages = $pages;
	}


	/**
	 * @return int
	 */
	public function getPages() : int
	{
		return $this->pages;
	}


	public function renderPages()
	{
		$template = $this->createTemplate();
		$template->setFile(__DIR__.'/templates/paginator.latte');
		$template->add('pages', $this->pages);
		$template->add('page', $this->page);
		$template->render();
	}


	public function renderPerPage()
	{
		$template = $this->createTemplate();
		$template->setFile(__DIR__.'/templates/perPage.latte');
		$template->add('perPages', $this->perPages);
		$template->add('perPage', $this->perPage);
		$template->render();
	}
}
