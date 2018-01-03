<?php declare(strict_types=1);

namespace Hashing\Functions;

interface IFunction
{

	/**
	 * @param $value
	 * @return int
	 */
	public function __invoke($value): int;

}
