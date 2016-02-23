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
		$template->setFile(__DIR__.'/../templates/table.latte');
		$template->add('data', $this->getData());
		$template->render();
	}
}
