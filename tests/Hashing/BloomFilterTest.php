<?php declare(strict_types=1);

namespace Tests\Hashing;

use Hashing\BloomFilter;
use Hashing\Functions\IFunction;
use Hashing\Functions\Md5Function;
use PHPUnit\Framework\TestCase;

final class BloomFilterTest extends TestCase
{

	public function testInsert()
	{
		$filter = new BloomFilter();

		$filter->insert(1);
		$filter->insert(500);

		static::assertTrue($filter->check(1));
		static::assertTrue($filter->check(500));
		static::assertFalse($filter->check(2650));
		static::assertFalse($filter->check(PHP_INT_MAX));
		static::assertFalse($filter->check(-9));
	}

	public function testSetFunctions(): void
	{
		$filter = new BloomFilter();

		$filter->setHashFunctions([
			new class implements IFunction
			{
				/**
				 * @param mixed $value
				 * @return int
				 */
				public function __invoke($value): int
				{
					return (int)(($value * 2) / 2.5);
				}
			},
			new Md5Function()
		]);

		$filter->insert(1);
		$filter->insert(500);

		static::assertTrue($filter->check(1));
		static::assertTrue($filter->check(500));
		static::assertFalse($filter->check(2650));
		static::assertFalse($filter->check(PHP_INT_MAX));
		static::assertFalse($filter->check(-9));
	}

}
