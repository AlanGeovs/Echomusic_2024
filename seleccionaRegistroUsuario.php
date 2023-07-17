<?php

 if($_GET["formRegistroTipoUser"] == 'usuario'){
     header("Location: registro_usuario.php");
 }
 if($_GET["formRegistroTipoUser"] == 'artista'){
     header("Location: registro_artista.php");
 }
 if($_GET["formRegistroTipoUser"] == 'espacio'){
     header("Location: registro_espacio.php");
 }
 
