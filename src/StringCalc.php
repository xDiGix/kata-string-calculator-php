<?php declare(strict_types=1);

namespace Kata;

/**
 * @link https://kata-log.rocks/string-calculator-kata
 * 
 */
final class StringCalc {

  public function add(string $string): int {
    if ($string === '1') {
      return 1;
    }
    return 0;
  }
}