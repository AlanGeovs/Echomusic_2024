<?php

require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'https://lodela.com.mx/', 
    'ck_dd807d9667c26c0e14877158f2398acc8b883eae', 
    'cs_bbf183e6e0347424b9ce1b048cf73ca9be9bed89',
    [
        'version' => 'wc/v3',
        'wp_api' => true,
        'query_string_auth' => true,
        'verify_ssl' => false,
    ]
);

 print_r('<br>Listar Ordenes:');
//List all orders
 echo '<pre><code>';
 print_r($woocommerce->get('orders'));
 echo '</code><pre>';

// print_r('<br>Listar Productos:');
// 
// print_r($woocommerce->get('products'));
 
// print_r('<br><br>NOTAS<br>:');
// 
// print_r($woocommerce->get('orders/723/notes'));
 
 
 print_r('<br>Pago:');
//Crear una orden

//$data = [
//    'payment_method' => 'bacs',
//    'payment_method_title' => 'Transferencia bancaria directa',
//    'set_paid' => true,
//    'billing' => [
//        'first_name' => 'Alan',
//        'last_name' => 'V',
//        'address_1' => '969 Market',
//        'address_2' => '',
//        'city' => 'San Francisco',
//        'state' => 'CA',
//        'postcode' => '94103',
//        'country' => 'US',
//        'email' => 'alan@genesysapp.com',
//        'phone' => '(555) 555-5555'
//    ],
//    'shipping' => [
//        'first_name' => 'Alan',
//        'last_name' => 'V',
//        'address_1' => '969 Market',
//        'address_2' => '',
//        'city' => 'San Francisco',
//        'state' => 'CA',
//        'postcode' => '94103',
//        'country' => 'US'
//    ],
//    'line_items' => [
//        [
//            'product_id' => 1638,
//            'quantity' => 2
//        ],
//        [
//            'product_id' => 1769 , 
//            'quantity' => 1
//        ]
//    ] 
//];
//
//print_r($woocommerce->post('orders', $data));
// 