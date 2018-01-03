<?php declare(strict_types=1);

namespace Hashing\Functions;

final class Sha1Function implements IFunction
{

	/**
	 * @param mixed $value
	 * @return int
	 */
	public function __invoke($value): int
	{
		return \intval(substr(sha1((string)$value), 0, 8), 16);
	}
}
