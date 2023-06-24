<?php

 function encrypt($string)
 {
    $clave = "op$2o23";
     $result = '';
     for ($i = 0; $i < strlen($string); $i++) {
         $char = substr($string, $i, 1);
         $keychar = substr($clave, ($i % strlen($clave)) - 1, 1);
         $char = chr(ord($char) + ord($keychar));
         $result .= $char;
     }
     return base64_encode($result);
 }


 function decrypt($string)
 {
    $clave = "op$2o23";
     $result = '';
     $string = base64_decode($string);
     for ($i = 0; $i < strlen($string); $i++) {
         $char = substr($string, $i, 1);
         $keychar = substr($clave, ($i % strlen($clave)) - 1, 1);
         $char = chr(ord($char) - ord($keychar));
         $result .= $char;
     }
     return $result;
 }
