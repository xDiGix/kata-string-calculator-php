<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Kata\StringCalc;

/**
 * command "punit tests" alias of "php ./vendor/bin/phpunit tests"
 */
final class StringCalcTest extends TestCase {
  public function testSumEmptyString(): void {
    $stringCalc = new StringCalc();
    $sum = $stringCalc->add('');
    $this->assertSame(0, $sum);
  }

  public function testSumOneString(): void {
    $stringCalc = new StringCalc();
    $sum = $stringCalc->add('1');
    $this->assertSame(1, $sum);
  }

  public function testSumOneTwoString(): void {
    $stringCalc = new StringCalc();
    $sum = $stringCalc->add('1,2');
    $this->assertSame(3, $sum);
  }

  public function testSumFiveOneString(): void {
    $stringCalc = new StringCalc();
    $sum = $stringCalc->add('5,1');
    $this->assertSame(6, $sum);
  }

  public function testSumThreeFiveOneString(): void {
    $stringCalc = new StringCalc();
    $sum = $stringCalc->add('3,5,1');
    $this->assertSame(9, $sum);
  }

  public function testSumWithDifferentSeparetorString(): void {
    $stringCalc = new StringCalc();
    $sum = $stringCalc->add('1\n2,3');
    $this->assertSame(6, $sum);
  }

  public function testSumWithDifferentSeparetorDoubleQuoteString(): void {
    $stringCalc = new StringCalc();
    $sum = $stringCalc->add("1\n2,3");
    $this->assertSame(6, $sum);
  }

  public function testSumWithPassedDelimiterFormatString(): void {
    $stringCalc = new StringCalc();
    $sum = $stringCalc->add("//;\n1;2");
    $this->assertSame(3, $sum);
  }

  public function testSumWithPassedDelimiterFormatTwoCharString(): void {
    $stringCalc = new StringCalc();
    $sum = $stringCalc->add('//;;\n1;;2');
    $this->assertSame(3, $sum);
  }
}