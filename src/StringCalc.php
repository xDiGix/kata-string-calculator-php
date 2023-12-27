<?php declare(strict_types=1);

namespace Kata;

/**
 * @link https://kata-log.rocks/string-calculator-kata
 * 
 */
final class StringCalc {

  private $delimiter = '(,|\n|\\\n)';

  public function add(string $string): int {
    $sum = 0;
    

    if ($string === '') {
      return $sum;
    }

    $string = $this->handleDelimiterFormat($string);

    $delimiter = $this->delimiter;

    $numbers = preg_split('/' . $delimiter . '/', $string);
    $numbers = array_map('intval', $numbers);
    
    $this->validateNumbers($numbers);

    $sum = array_sum($numbers);
    
    return $sum;
  }

  private function handleDelimiterFormat(string $string): string {
    if (strpos($string, '//') !== 0) {
      return $string;
    }

    list($delimiterFormat, $string) = preg_split('/(\n|\\\n)/', $string);
    $this->delimiter = substr($delimiterFormat, 2);

    return $string;
  }

  private function validateNumbers(array $numbers): void {
    $negativeNumbers = array_filter($numbers, function ($number) {
      return $number < 0;
    });
    if (!empty($negativeNumbers)) {
      throw new \InvalidArgumentException('Negatives not allowed: ' . implode(', ', $negativeNumbers));
    }
  }
}