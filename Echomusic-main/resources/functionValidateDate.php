<?php
 // Validate date function
 function validateDate($date, $format = 'd-m-Y'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
  }

 function validateDate2($date, $format = 'd-m-Y H:i'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
  }
?>
