<?php
// Function Dias Español
  function getDayday($date){
    $day = DATE_FORMAT($date, 'D d');
    switch(true){
      case strpos($day, "Mon") !== false:
        $day = str_replace("Mon", "Lunes", $day);
        echo $day;
      break;
      case strpos($day, "Tue") !== false:
        $day = str_replace("Tue", "Martes", $day);
        echo $day;
      break;
      case strpos($day, "Wed") !== false:
        $day = str_replace("Wed", "Miércoles", $day);
        echo $day;
      break;
      case strpos($day, "Thu") !== false:
        $day = str_replace("Thu", "Jueves", $day);
        echo $day;
      break;
      case strpos($day, "Fri") !== false:
        $day = str_replace("Fri", "Viernes", $day);
        echo $day;
      break;
      case strpos($day, "Sat") !== false:
        $day = str_replace("Sat", "Sábado", $day);
        echo $day;
      break;
      case strpos($day, "Sun") !== false:
        $day = str_replace("Sun", "Domingo", $day);
        echo $day;
      break;
    }

  }
// Function Meses Español
  function getMonthYear($date){
    $month = DATE_FORMAT($date, 'M Y');
    switch(true){
      case strpos($month, "Jan") !== false:
        $month = str_replace("Jan", "Enero", $month);
        echo $month;
      break;
      case strpos($month, "Feb") !== false:
        $month = str_replace("Feb", "Febrero", $month);
        echo $month;
      break;
      case strpos($month, "Mar") !== false:
        $month = str_replace("Mar", "Marzo", $month);
        echo $month;
      break;
      case strpos($month, "Apr") !== false:
        $month = str_replace("Apr", "Abril", $month);
        echo $month;
      break;
      case strpos($month, "May") !== false:
        $month = str_replace("May", "Mayo", $month);
        echo $month;
      break;
      case strpos($month, "Jun") !== false:
        $month = str_replace("Jun", "Junio", $month);
        echo $month;
      break;
      case strpos($month, "Jul") !== false:
        $month = str_replace("Jul", "Julio", $month);
        echo $month;
      break;
      case strpos($month, "Aug") !== false:
        $month = str_replace("Aug", "Agosto", $month);
        echo $month;
      break;
      case strpos($month, "Sep") !== false:
        $month = str_replace("Sep", "Septiembre", $month);
        echo $month;
      break;
      case strpos($month, "Oct") !== false:
        $month = str_replace("Oct", "Octubre", $month);
        echo $month;
      break;
      case strpos($month, "Nov") !== false:
        $month = str_replace("Nov", "Noviembre", $month);
        echo $month;
      break;
      case strpos($month, "Dec") !== false:
        $month = str_replace("Dec", "Diciembre", $month);
        echo $month;
      break;
    }
  }

 ?>
