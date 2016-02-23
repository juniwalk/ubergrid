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
	public $pages;


	/**
	 * @param int  $page
	 */
	public function handlePage($page)
	{
		$perPage = $this->getParent()->getComponent('perPage');
		$table = $this->getParent()->getComponent('table');

		$this->pages = ceil(sizeof($table->data) / $perPage->perPage);


		$this->page = min(max($page, 1), $this->pages);

		if (!$this->getPresenter()->isAjax()) {
			$this->redirect('this');
		}

		$this->getParent()['table']->redrawControl();
		$this->redrawControl();
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
