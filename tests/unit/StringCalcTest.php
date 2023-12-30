<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Kata\StringCalc;

/**
 * command "punit tests" alias of "php ./vendor/bin/phpunit tests"
 */
final class StringCalcTest extends TestCase {

  private $stringCalc;

  protected function setUp(): void {
    $this->stringCalc = new StringCalc();
  }

  public function testSumEmptyString(): void {
    $sum = $this->stringCalc->add('');
    $this->assertSame(0, $sum);
  }

  /**
   * @dataProvider sumStringDataProvider
   */
  public function testSumString(string $string, int $sum): void {
    $this->assertSame($sum, $this->stringCalc->add($string));
  }

  public function testSumWithDifferentSeparetorString(): void {
    $sum = $this->stringCalc->add('1\n2,3');
    $this->assertSame(6, $sum);
  }

  public function testSumWithDifferentSeparetorDoubleQuoteString(): void {
    $sum = $this->stringCalc->add("1\n2,3");
    $this->assertSame(6, $sum);
  }

  public function testSumWithPassedDelimiterFormatString(): void {
    $sum = $this->stringCalc->add("//;\n1;2");
    $this->assertSame(3, $sum);
  }

  public function testSumWithPassedDelimiterFormatTwoCharString(): void {
    $sum = $this->stringCalc->add('//;;\n1;;2');
    $this->assertSame(3, $sum);
  }

  public function testSumWithOneNegativeString(): void {

    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('Negatives not allowed: -1');

    $sum = $this->stringCalc->add('-1');
  }

  public function testSumIgnoreNumbersBiggerThan1000String(): void {
    $sum = $this->stringCalc->add('2,1001');
    $this->assertSame(2, $sum);
  }

  public function testSumWithPassedAnyLengthDelimiterFormatString(): void {
    $sum = $this->stringCalc->add('//[***]\n1***2***3');
    $this->assertSame(6, $sum);
  }

  public function testSumWithPassedMultipleDelimiterFormatString(): void {
    $sum = $this->stringCalc->add('//[*][%]\n1*2%3');
    $this->assertSame(6, $sum);
  }

  public function testSumWithPassedMultipleAndAnyLengthDelimiterFormatString(): void {
    $sum = $this->stringCalc->add('//[***][%%]\n3***3%%3');
    $this->assertSame(9, $sum);
  }

  public static function sumStringDataProvider(): array {
    return [
      ['1', 1],
      ['1,2', 3],
      ['1,2,3', 6],
      ['5,1', 6],
      ['3,5,1', 9],
      ['2,1000', 1002],
    ];
  }
}