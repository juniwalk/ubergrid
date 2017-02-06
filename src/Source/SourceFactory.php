<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Übergrid
 * @link      https://github.com/juniwalk/ubergrid
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Ubergrid\Source;

final class SourceFactory
{
	/**
	 * @param  mixed  $data
	 * @return Source
	 * @throws Exception
	 */
	public function create($data) : Source
	{
		switch (TRUE) {
			case is_array($data):
				return new ArraySource($data);
				break;
		}

		throw new \Exception('Invalid data source');
	}
}
