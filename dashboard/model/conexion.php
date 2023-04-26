<?php

class Conexion{
	public static function conectar(){
		//$link= new PDO("mysql:host=localhost; dbname=trademar_tmk","root","");
		$link= new PDO("mysql:host=localhost; dbname=am_inventariov2","am_inventariov2","Y)])HDIHRo&p");
		return $link;
	} 
}