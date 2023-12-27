<?php declare(strict_types=1);

namespace Kata;

/**
 * Class StringCalc implements string calculator for strings like "1,2,3" or different delimiters
 * 
 * @link https://kata-log.rocks/string-calculator-kata
 */
final class StringCalc {

  private $delimiter = '(,|\n|\\\n)';
  private $maxNumber = 1000;

  /**
   * Method to add numbers in a string like "1,2,3"
   * 
   * @param string $string
   * @return int
   */
  public function add(string $string): int {
    $sum = 0;

    if ($string === '') {
      return $sum;
    }

    $string = $this->handleDelimiterFormat($string);

    $delimiter = $this->delimiter;

    // extract numbers
    $numbers = preg_split('/' . $delimiter . '/', $string);
    // map numbers to int
    $numbers = array_map('intval', $numbers);
    
    $this->validateNumbers($numbers);
    $numbers = $this->removeIgnoreNumbers($numbers);

    $sum = array_sum($numbers);
    
    return $sum;
  }

  /**
   * Method to handle delimiter formats like '//;\n1;2' and '//[***]\n1***2***3' and '//[*][%]\n1*2%3'
   *  
   * @param string $string
   * @return string
   */
  private function handleDelimiterFormat(string $string): string {
    if (strpos($string, '//') !== 0) {
      return $string;
    }

    // extract delimiter format and string
    list($delimiterFormat, $string) = preg_split('/(\n|\\\n)/', $string);
    // remove delimiter format
    $delimiter = substr($delimiterFormat, 2);
    // extract delimiters
    preg_match_all('/\[(.+?)\]/', $delimiter, $matches);
    if (!empty($matches[1])) {
      // fix delimiter for regex
      $delimiter = array_map('preg_quote', $matches[1]);
      $delimiter = implode('|', $delimiter);
    }
    $this->delimiter = $delimiter;
    
    return $string;
  }

  /**
   * Method to validate numbers
   * 
   * @param array $numbers
   * @throws \InvalidArgumentException
   * @return void
   */
  private function validateNumbers(array $numbers): void {
    $negativeNumbers = array_filter($numbers, function ($number) {
      return $number < 0;
    });
    if (!empty($negativeNumbers)) {
      throw new \InvalidArgumentException('Negatives not allowed: ' . implode(', ', $negativeNumbers));
    }
  }

  /**
   * Method to remove numbers greater than maxNumber
   * 
   * @param array $numbers
   * @return array
   */
  private function removeIgnoreNumbers(array $numbers): array {
    return array_filter($numbers, function ($number) {
      return $number <= $this->maxNumber;
    });
  }
}