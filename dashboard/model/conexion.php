<?php

class Conexion{
	public static function conectar(){ 
//		$link= new PDO("mysql:host=localhost; dbname=echomusicnet_db","echomusicnet_db","W4dR9+L/Mi8");
		$link= new PDO("mysql:host=localhost; dbname= echomusicnet_db"," echomusicnet_db","W4dR9+L/Mi8");
		return $link;
	} 
}