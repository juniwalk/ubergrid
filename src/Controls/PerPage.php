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


	public function render()
	{
		$template = $this->createTemplate();
		$template->setFile(__DIR__.'/../templates/perPage.latte');
		$template->add('perPages', $this->perPages);
		$template->add('perPage', $this->perPage);
		$template->render();
	}
}
