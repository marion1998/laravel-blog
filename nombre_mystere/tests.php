<?php
    declare(strict_types=1);

    use PHPUnit\Framework\TestCase;

    require ('./index.php');

    final class Test extends TestCase{



        public function testnumberbetween0and9(){
            $this->assertGreaterThanOrEqual(0, MartinMystere::defineNumber());
            $this->assertLessThanOrEqual(9, MartinMystere::defineNumber());
        }



        public function testwrongAnswerSmaller(){
            $answer = 3;
            $chosen = 6;
            $this->assertEqual('Wrong. It\'s less', MartinMystere::testAnswer($answer, $chosen));
        }

        public function testwrongAnswerBigger(){
            $answer = 3;
            $chosen = 1;
            $this->assertEqual("Wrong. It's more", MartinMystere::testAnswer($answer, $chosen));
        }
    }
?>