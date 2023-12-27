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
}