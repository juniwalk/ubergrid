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
	private $pages = 3;


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


	public function render()
	{
		$template = $this->createTemplate();
		$template->setFile(__DIR__.'/../templates/paginator.latte');
		$template->add('pages', $this->pages);
		$template->add('page', $this->page);
		$template->render();
	}
}
