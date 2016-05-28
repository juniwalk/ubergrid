<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid\Components;

class PerPage extends \Nette\Application\UI\Control
{
	/** @val int @persistent */
	public $perPage = 10;

	/** @var array */
	private $perPages = [10, 20, 50, 0];


	/**
	 * @param int  $perPage
	 */
	public function handlePerPage($perPage)
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
	 * @param int  $perPage
	 */
	public function setPerPage($perPage)
	{
		$this->perPage = $perPage;
	}


	/**
	 * @return int
	 */
	public function getPerPage()
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
	public function getPerPages()
	{
		return $this->perPages;
	}


	public function render()
	{
		$template = $this->createTemplate();
		$template->setFile(__DIR__.'/../templates/perPage.latte');
		$template->add('perPages', $this->perPages);
		$template->add('perPage', $this->perPage);
		$template->render();
	}
}
