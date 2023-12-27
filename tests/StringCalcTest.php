<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Kata\StringCalc;

/**
 * command "punit tests" alias of "php ./vendor/bin/phpunit tests"
 */
final class StringCalcTest extends TestCase {
  public function testSumEmptyString(): void {
    $stringCalc = new StringCalc();
    $this->assertEquals(0, $stringCalc->add(''));
  }
}