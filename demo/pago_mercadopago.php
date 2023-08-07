<?php
 
$url = "https://api.mercadopago.com/v1/payments";

$access_token="TEST-6096095892813616-071719-5d6361e499bf1cecde39a75f6f96af6e-1410934778";

$headers = array(
    'Authorization' => 'Bearer ' .$access_token
);
$data = array (
  'additional_info' => 
  array (
    'items' => 
    array (
      0 => 
      array (
        'id' => 'MLB2907679857q',
        'title' => 'Point Minia',
        'description' => 'aProducto Point para cobros con tarjetas mediante bluetooth',
        'picture_url' => 'https://http2.mlstatic.com/resources/frontend/statics/growth-sellers-landings/device-mlb-point-i_medium2x.png',
        'category_id' => 'electronics',
        'quantity' => 1,
        'unit_price' => 100,
      ),
    ),
    'payer' => 
    array (
      'first_name' => 'Test1',
      'last_name' => 'Test1',
      'e-mail' => 'test_user_1231@testuser.com',
      'phone' => 
      array (
        'area_code' => 111,
        'number' => '9876543211',
      ),
      'address' => 
      array (
      ),
    ),
    'shipments' => 
    array (
      'receiver_address' => 
      array (
        'zip_code' => '12312-1231',
        'state_name' => 'Rio de Janeiro1',
        'city_name' => 'Buzios1',
        'street_name' => 'Av das Nacoes Unidas1',
        'street_number' => 30031,
      ),
    ),
  ),
  'description' => 'Payment for product1',
  'external_reference' => 'MP00011',
  'installments' => 1,
  'metadata' => 
  array (
  ),
  'payer' => 
  array (
    'entity_type' => 'individual',
    'type' => 'customer',
    'identification' => 
    array (
    ),
  ),
  'payment_method_id' => 'visa',
  'token' => 'ff8080814c11e237014c1ff593b57b4d1',
  'transaction_amount' => 100,
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