<?php 

//$url = "https://localhost/wordpress/wp-json/wc/v3/products/455";
$url = "https://lodela.com.mx/wp-json/wc/v3/products/1638";

$consumer_key = 'ck_dd807d9667c26c0e14877158f2398acc8b883eae';
$consumer_secret = 'cs_bbf183e6e0347424b9ce1b048cf73ca9be9bed89';

$headers = array(
    'Authorization' => 'Basic ' . base64_encode($consumer_key.':'.$consumer_secret )
);
$data = array(
    'regular_price' => '2500', 
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
print_r(json_decode($resp));