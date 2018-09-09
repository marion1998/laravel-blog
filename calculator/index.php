<?php
    class Calculator {
        static function calculate($number){

        if ($number == null || $number == ""){
            return 0;
        }else{
            eval('$answer =' . $number . ';');
            return $answer;
        }

        }
    }
?>