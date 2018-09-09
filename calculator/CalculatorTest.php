<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require ("./index.php");


final class calculatorTest extends TestCase
{
  public function testNumber0CanBeUnderstood(){
    $this->assertEquals('0', Calculator::calculate('0'));
  }

  public function testNumber1CanBeUnderstood(){
    $this->assertEquals('1', Calculator::calculate('1'));
  }

  public function testNoInput(){
    $this->assertEquals('0', Calculator::calculate(null));
  }
  
  public function testEmptyInput(){
    $this->assertEquals('0', Calculator::calculate(""));
  }

  public function testAddition(){
    $this->assertEquals(3, Calculator::calculate('1+2'));
  }
}


?>
