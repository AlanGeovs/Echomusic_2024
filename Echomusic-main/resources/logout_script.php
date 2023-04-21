<?php

//if (!isset($_SESSION['user']) && $_SESSION['user'] !="") {

session_start();
    session_unset();
    session_destroy();
    session_write_close();
   header("Refresh:3; url=index.php");
 //}
?>
