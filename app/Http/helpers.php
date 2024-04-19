<?php

    if (!function_exists('sumValue')) {
       function sumValue($value)
       {
            $digits = str_split($value);
            $sum = array_sum($digits);
            $stringValue = (string)$sum;
            return substr($stringValue, -1);
    }
    }
    
    if (!function_exists('getLeftRightValue')) {
       function getLeftRightValue($value,$side)
       {
           if($side == 'left')
            return substr(strval($value), 0, 1);
            return substr(strval($value), -1);
       }
      }
      
      



