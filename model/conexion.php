<?php 
	# conectare la base de datos
    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
	# obtengo la zona horaria registrada en la db
	function get_timezone(){
		global $con,$timezone;
		$sql=mysqli_query($con, "select timezones.name from business_profile, timezones where business_profile.timezone_id=timezones.id and business_profile.id=1");	
		$rw=mysqli_fetch_array($sql);
		$timezone_name=$rw['name'];
		$timezone=date_default_timezone_set($timezone_name);
		return $timezone;
	}
	
	# obtengo los datos de la moneda actual
	function get_currency(){
		global $con,$timezone;
		$sql=mysqli_query($con, "select currencies.name,  currencies.symbol, currencies.precision_currency, currencies.thousand_separator, currencies.decimal_separator, currencies.code from business_profile,  currencies where business_profile.currency_id=currencies.id and business_profile.id=1");	
		$rw=mysqli_fetch_array($sql);
		return $rw;
	}
	get_timezone();//Establece la zona horaria
	$currency_format= get_currency();//Arrary que devuelve los datos de 1 moneda
?>
