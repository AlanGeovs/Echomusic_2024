<?php 
 
$url = "https://lodela.com.mx/wp-json/wc/v3/orders";

$consumer_key = 'ck_dd807d9667c26c0e14877158f2398acc8b883eae'; 
$consumer_secret = 'cs_bbf183e6e0347424b9ce1b048cf73ca9be9bed89';

$headers = array(
    'Authorization' => 'Basic ' . base64_encode($consumer_key.':'.$consumer_secret )
);
$data = array(
    'payment_method' => 'bacs',
    'payment_method_title' => 'Transferencia bancaria directa',
    'set_paid' => true,
    'billing' => [
        'first_name' => 'Sitic',
        'last_name' => 'X',
        'address_1' => 'qwe',
        'address_2' => '',
        'city' => 'Ciudad de México',
        'state' => 'Ciudad de México',
        'postcode' => '03500',
        'country' => 'MX',
        'email' => 'alan@sitic.net',
        'phone' => '(555) 555-5555'
    ],
    'shipping' => [
        'first_name' => 'Alan',
        'last_name' => 'V',
        'address_1' => '969 Market',
        'address_2' => '',
        'city' => 'San Francisco',
        'state' => 'CA',
        'postcode' => '94103',
        'country' => 'US'
    ],
    'line_items' => [
        [
            'product_id' => 1769,
            'quantity' => 5
        ] 
    ] 
);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_USERPWD, "$consumer_key:$consumer_secret");
$resp = curl_exec($curl);
$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
curl_close($curl);

 
//caapturamos la respuesta dela petición
if($status_code == 200 || $status_code == 201 || $status_code == 202|| $status_code == 203|| $status_code == 204){
    echo '<h2>Pedido realizado</h2>';
}else{
    echo "<h2>Error</h2>";
    echo "Respuesta: ".$status_code;
    
}

echo "<pre>";
print_r(json_decode($resp));
echo "</pre>";