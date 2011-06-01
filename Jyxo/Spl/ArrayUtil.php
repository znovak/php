<?php

/**
 * Jyxo PHP Library
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * https://github.com/jyxo/php/blob/master/license.txt
 */

namespace Jyxo\Spl;

/**
 * Utilities for working with arrays.
 *
 * @category Jyxo
 * @package Jyxo\Spl
 * @copyright Copyright (c) 2005-2011 Jyxo, s.r.o.
 * @license https://github.com/jyxo/php/blob/master/license.txt
 * @author Jakub Tománek
 */
class ArrayUtil
{
	/**
	 * Creates an array containing item range. Similar to range() but with closures.
	 * Params $low and $high are inclusive. If $low > $high, resulting array will be in descending order.
	 *
	 * @param mixed $low Minimal value
	 * @param mixed $high Maximal value
	 * @param \Closure $step Closure which creates next value from current
	 * @param \Closure $compare comparing closure for detecting if we're at the end of the range (Optional)
	 * @return array
	 */
	public static function range($low, $high, \Closure $step, \Closure $compare = null)
	{
		$data = array($low);
		$stepDown = $low > $high;
		$compare = $compare ?: function ($a, $b) use ($stepDown) {
			return $stepDown ? $a > $b : $a < $b;
		};

		$current = $low;
		while ($compare($current, $high)) {
			$data[] = $current = $step($current);
		}
		return $data;
	}

	/**
	 * Creates an associative array from iterator which doesn't return proper keys.
	 * Keys are generated by applying callback $key to the current value.
	 * It is also possible to apply another callback directly to the value.
	 * Key callback is called BEFORE value callback.
	 *
	 * <code>
	 * // Example usage
	 * $data = \Jyxo\Spl\ArrayUtil::keymap($iterator, function(Object $object) {
	 * 	return $object->getId();
	 * });
	 * </code>
	 *
	 * @param \Traversable $traversable Iterator
	 * @param \Closure $key Closure for generating keys
	 * @param \Closure $value Closure for modifying data (Optional)
	 * @return array
	 */
	public static function keymap(\Traversable $traversable, \Closure $key, \Closure $value = null)
	{
		$data = array();
		foreach ($traversable as $item) {
			$data[$key($item)] = $value ? $value($item) : $item;
		}
		return $data;
	}
}
