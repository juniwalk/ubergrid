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
	private $data;


	/**
	 * @param mixed  $data
	 */
	public function setData($data)
	{
		$this->data = $data;
	}


	/**
	 * @return stdClass[]
	 */
	public function getData()
	{
		$paginator = $this->getParent()->getComponent('paginator');
		$perPage = $this->getParent()->getComponent('perPage');

		if (!$perPage->perPage) {
			return $this->data;
		}

		$offset = ($paginator->page - 1) * $perPage->perPage;
		$paginator->pages = ceil(sizeof($this->data) / $perPage->perPage);

		return array_slice($this->data, $offset, $perPage->perPage);
	}


	/**
	 * @return int
	 */
	public function getCount()
	{
		return sizeof($this->data);
	}


	public function render()
	{
		$template = $this->createTemplate();
		$template->setFile(__DIR__.'/../templates/table.latte');
		$template->add('data', $this->getData());
		$template->render();
	}
}
