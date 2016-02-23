<?php

namespace App\Controls;

final class UberGrid extends \Nette\Application\UI\Control
{
	/** @var int @persistent */
	public $page = 1;

	/** @var int */
	private $pages = 3;

	/** @val int @persistent */
	public $perPage = 10;

	/** @var array */
	private $perPages = [10, 20, 50, 0];

	/** @var array */
	private $data = [
		1 => [
			['id' => 1, 'firstName' => 'Mark', 'lastName' => 'Otto', 'username' => 'mdo'],
			['id' => 2, 'firstName' => 'Jacob', 'lastName' => 'Thornton', 'username' => 'fat'],
			['id' => 3, 'firstName' => 'Larry', 'lastName' => 'the Bird', 'username' => 'twitter'],
		],
		2 => [
			['id' => 4, 'firstName' => 'Satya', 'lastName' => 'Nadella', 'username' => 'satyanadella'],
			['id' => 5, 'firstName' => 'Rudy', 'lastName' => 'Huyn', 'username' => 'RudyHuyn'],
			['id' => 6, 'firstName' => 'Tom', 'lastName' => 'Warren', 'username' => 'omwarren'],
		],
		3 => [
			['id' => 7, 'firstName' => 'Scott', 'lastName' => 'Hanselman', 'username' => 'shanselman'],
		],
	];


	/**
	 * @param int  $page
	 */
	public function handlePage($page)
	{
		$this->page = min(max($page, 1), $this->pages);

		if (!$this->getPresenter()->isAjax()) {
			$this->redirect('this');
		}

		// DOES WORK - whole grid is redrawn
		$this->redrawControl();
	}


	/**
	 * @param int  $perPage
	 */
	public function handlePerPage($perPage)
	{
		if (in_array($perPage, $this->perPages)) {
			$this->perPage = $perPage;
		}

		if (!$this->getPresenter()->isAjax()) {
			$this->redirect('this');
		}

		// DOES NOT WORK - snippets wont be sent over
		$this->redrawControl('perPage');
		$this->redrawControl('data');
	}


	/**
	 * @return array
	 */
	public function getData()
	{
		if (!isset($this->data[$this->page])) {
			return [];
		}

		return $this->data[$this->page];
	}


	public function render()
	{
		$template = $this->createTemplate();
		$template->setFile(__DIR__.'/templates/uberGrid.latte');
		$template->render();
	}

	public function renderTable()
	{
		$template = $this->createTemplate();
		$template->setFile(__DIR__.'/templates/table.latte');
		$template->add('data', $this->getData());
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

	public function renderPaginator()
	{
		$template = $this->createTemplate();
		$template->setFile(__DIR__.'/templates/paginator.latte');
		$template->add('pages', $this->pages);
		$template->add('page', $this->page);
		$template->render();
	}
}

interface IUberGridFactory
{
	/**
	 * @return UberGrid
	 */
	public function create();
}
