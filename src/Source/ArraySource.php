<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid\Source;

use JuniWalk\Ubergrid\Filter\Filter;

final class ArraySource extends AbstractSource
{
	/**
	 * @var array
	 */
	private $data = [];

	/**
	 * @var int
	 */
	private $count = 0;


	/**
	 * @param array  $data
	 */
	public function __construct(array $data)
	{
		$this->count = sizeof($data);
		$this->data = $data;
	}


	/**
	 * @return int
	 */
	public function getCount() : int
	{
		return sizeof($this->data);
	}


	/**
	 * @return array
	 */
	public function getData() : array
	{
		return $this->data;
	}


	/**
	 * @param  Filter[]  $filters
	 * @return static
	 */
	public function filter(array $filters) : self
	{
	}


	/**
	 * @param  Filter  $filter
	 * @return static
	 */
	public function filterOne(Filter $filter) : self
	{

	}


	/**
	 * @param  int  $offset
	 * @param  int  $limit
	 * @return static
	 */
	public function limit(int $offset, int $limit) : self
	{
		$this->data = array_slice($this->data, $offset, $limit);
		return $this;
	}
}
