<?php declare(strict_types=1);

namespace Hashing\Functions;

final class Md5Function implements IFunction
{

	/**
	 * @param $value
	 * @return int
	 */
	public function __invoke($value): int
	{
		return \intval(substr(md5((string)$value), 0, 8), 16);
	}
}
