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

interface Source
{
	/**
	 * @return int
	 */
	public function getCount() : int;


	/**
	 * @return array
	 */
	public function getData() : array;


	/**
	 * @param  Filter[]  $filters
	 * @return static
	 */
	public function filter(array $filters);


	/**
	 * @param  Filter  $filter
	 * @return static
	 */
	public function filterOne(Filter $filter);


	/**
	 * @param  int  $offset
	 * @param  int  $limit
	 * @return static
	 */
	public function limit(int $offset, int $limit);


	/**
	 * @param  Sorting  $sorting
	 * @return static
	 */
	//public function sort(Sorting $sorting);
}
