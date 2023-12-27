<?php declare(strict_types=1);

namespace Kata;

/**
 * @link https://kata-log.rocks/string-calculator-kata
 * 
 */
final class StringCalc {

  public function add(string $string): int {
    $sum = 0;

    if ($string === '') {
      return $sum;
    }

    $numbers = preg_split('/(,|\n|\\\n)/', $string);
    $numbers = array_map('intval', $numbers);
    $sum = array_sum($numbers);
    
    return $sum;
  }
}