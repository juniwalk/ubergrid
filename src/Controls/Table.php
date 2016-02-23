<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid\Components;

class Table extends \Nette\Application\UI\Control
{
	/** @var stdClass[] */
	public $data;


	public function __construct()
	{
		$this->data = json_decode(file_get_contents(__DIR__.'/../data.json'));
	}


	/**
	 * @return stdClass[]
	 */
	public function getData()
	{
		$paginator = $this->getParent()->getComponent('paginator');
		$perPage = $this->getParent()->getComponent('perPage');

		$offset = ($paginator->page - 1) * $perPage->perPage;
		$paginator->pages = ceil(sizeof($this->data) / $perPage->perPage);

		return array_slice($this->data, $offset, $perPage->perPage);
	}


	public function render()
	{
		$template = $this->createTemplate();
		$template->setFile(__DIR__.'/../templates/table.latte');
		$template->add('data', $this->getData());
		$template->render();
	}
}
