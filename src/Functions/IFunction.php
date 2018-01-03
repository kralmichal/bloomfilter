<?php declare(strict_types=1);

namespace Hashing\Functions;

interface IFunction
{

	/**
	 * @param mixed $value
	 * @return int
	 */
	public function __invoke($value): int;

}
