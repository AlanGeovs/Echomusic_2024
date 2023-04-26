<?php

class Conexion{
	public static function conectar(){
		//$link= new PDO("mysql:host=localhost; dbname=trademar_tmk","root","");
		$link= new PDO("mysql:host=localhost; dbname=genesysa_echomisuc","genesysa_echomisuc","Y8vJ2.0Iw_Le");
		return $link;
	} 
}