<?php declare(strict_types=1);

namespace Kata;

/**
 * @link https://kata-log.rocks/string-calculator-kata
 * 
 */
final class StringCalc {

  private $defaultDelimiter = '(,|\n|\\\n)';

  public function add(string $string): int {
    $sum = 0;
    $delimiter = $this->defaultDelimiter;

    if ($string === '') {
      return $sum;
    }

    if (strpos($string, '//') === 0) {
      list($delimiterFormat, $string) = preg_split('/(\n|\\\n)/', $string);
      $delimiter = substr($delimiterFormat, 2);
    }

    $numbers = preg_split('/' . $delimiter . '/', $string);
    $numbers = array_map('intval', $numbers);
    $sum = array_sum($numbers);
    
    return $sum;
  }
}