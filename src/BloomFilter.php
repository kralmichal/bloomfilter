<?php declare(strict_types=1);

namespace Hashing;

use Hashing\Functions\Md5Function;
use Hashing\Functions\Sha1Function;
use SplFixedArray;

final class BloomFilter
{

	private $hashFunctions;

	/**
	 * @var \SplFixedArray
	 */
	private $storage;

	/**
	 * @var int
	 */
	private $size;

	/**
	 * @param int $size
	 */
	public function __construct(int $size = 20)
	{
		$this->size = $size;
		$this->storage = new SplFixedArray($size);

		foreach ($this->storage as $k => $v) {
			$this->storage[$k] = 0;
		}

		$this->hashFunctions = [
			new Md5Function(),
			new Sha1Function(),
		];
	}

	/**
	 * @param $input
	 */
	public function insert($input): void
	{
		foreach ($this->hashFunctions as $function) {
			$value = abs($function($input));

			$this->storage[$value % $this->size] = 1;
		}
	}

	/**
	 * @param $input
	 * @return bool
	 */
	public function check($input): bool
	{
		foreach ($this->hashFunctions as $function) {
			$value = abs($function((string)$input));

			if ($this->storage[$value % $this->size] === 0) {
				return FALSE;
			}
		}

		return TRUE;
	}

	/**
	 * @param callable[] $functions
	 */
	public function setHashFunctions(array $functions): void
	{
		$this->hashFunctions = $functions;
	}

}
