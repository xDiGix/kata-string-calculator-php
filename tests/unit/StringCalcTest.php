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

  /**
   * @test
   */
  public function getZeroWithEmptyString(): void {
    $sum = $this->stringCalc->add('');
    $this->assertSame(0, $sum);
  }

  /**
   * @test
   * @dataProvider sumStringDataProvider
   */
  public function getCorrectSumWithCommaDelimiter(string $string, int $sum): void {
    $this->assertSame($sum, $this->stringCalc->add($string));
  }

  /**
   * @test
   */
  public function getCorrectSumWithNewLineAndCommaDelimiter(): void {
    $sum = $this->stringCalc->add('1\n2,3');
    $this->assertSame(6, $sum);
  }

  /**
   * @test
   */
  public function getCorrectSumWithNewLineAndCommaDelimiterBetweenDoubleQuotes(): void {
    $sum = $this->stringCalc->add("1\n2,3");
    $this->assertSame(6, $sum);
  }

  /**
   * @test
   */
  public function getCorrectSumWithPassedDelimiterFormat(): void {
    $sum = $this->stringCalc->add("//;\n1;2");
    $this->assertSame(3, $sum);
  }

  /**
   * @test
   */
  public function getCorrectSumWithPassedDelimiterFormatOfTwoCharacters(): void {
    $sum = $this->stringCalc->add('//;;\n1;;2');
    $this->assertSame(3, $sum);
  }

  /**
   * @test
   */
  public function failsWithNegativeNumbers(): void {

    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('Negatives not allowed: -1');

    $sum = $this->stringCalc->add('-1');
  }

  /**
   * @test
   */
  public function IgnoreNumberBiggerThan1000(): void {
    $sum = $this->stringCalc->add('2,1001');
    $this->assertSame(2, $sum);
  }

  /**
   * @test
   */
  public function getCorrectSumWithPassedDelimiterFormatOfAnyLength(): void {
    $sum = $this->stringCalc->add('//[***]\n1***2***3');
    $this->assertSame(6, $sum);
  }

  /**
   * @test
   */
  public function getCorrectSumWithPassedMultipleDelimiterFormat(): void {
    $sum = $this->stringCalc->add('//[*][%]\n1*2%3');
    $this->assertSame(6, $sum);
  }

  /**
   * @test
   */
  public function getCorrectSumWithPassedMultipleAndAnyLengthDelimiterFormat(): void {
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