<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://id.s.core.csnglobal.net/connect/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'client_id=72e7124c-6445-436c-b120-ccc5e0202b2c&client_secret=%2Bjc3vPMWDla0SOKEaEsIdpAkqd9icMgW%2BLJa6vsFbno%3D&grant_type=client_credentials',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded',
    'Cookie: csncidcf=2EF5DF3C-7F07-4138-9D5F-2788FEF3311B'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

//--------------

//Crear GUID

function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }
    else {
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}

$GUID = getGUID();
echo $GUID;

//$curl = curl_init();
//
//curl_setopt_array($curl, array(
//  CURLOPT_URL => 'http://globalinventory-publicapi.stg.core.csnglobal.net/v1/vehicles/40e4f8e8-a1f4-4748-bad0-5515f3861828',
//  CURLOPT_RETURNTRANSFER => true,
//  CURLOPT_ENCODING => '',
//  CURLOPT_MAXREDIRS => 10,
//  CURLOPT_TIMEOUT => 0,
//  CURLOPT_FOLLOWLOCATION => true,
//  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//  CURLOPT_CUSTOMREQUEST => 'POST',
//  CURLOPT_POSTFIELDS =>'{
//    "PublishingDestinations": [
//        {
//            "Name": "SOLOAUTOS.MX"
//        }
//    ],
//    "Media": {
//        "Photos": [
//            {
//                "Url": "http://fotos.carplanet.mx/view/img/usedcars/hex99889/5fa300797e5ae/big/big_0.jpg",
//                "Order": "1"
//            },
//            {
//                "Url": "http://fotos.carplanet.mx/view/img/usedcars/hex99889/5fa300797e5ae/big/big_1.jpg",
//                "Order": "2"
//            },
//            {
//                "Url": "http://fotos.carplanet.mx/view/img/usedcars/hex99889/5fa300797e5ae/big/big_2.jpg",
//                "Order": "3"
//            }
//        ]
//    },
//    "Seller": {
//        "Identifier": "9a784c6e-7833-11ea-aff3-02ffd556d23c"
//    },
//   "Specification": {
//        "RecordType": "Autos, camionetas y 4x4",
//        "Make": "Volkswagen",
//        "Model": "Polo",
//        "ReleaseDate": {
//            "Year": 2019
//        },
//        "Title": "TESLA 2020 DESING SOUND 1.6L L4 105HP TM",
//        "ShortTitle": "TESLA MODEL 3 2020",
//        "Attributes": [
//           {
//                "Name": "Color",
//                "Group": "Detalles",
//                "DisplayName": "Color",
//                "Value": "Blanco",
//                "DisplayOnDetailsPage": true,
//                "IsKeyAttribute": false,
//                "IsDeleted": false
//            },
//            {
//                "Name": "DoorNumber",
//                "Group": "Detalles",
//                "DisplayName": "Puertas",
//                "Value": "4",
//                "DisplayOnDetailsPage": true,
//                "IsKeyAttribute": false,
//               "IsDeleted": false
//            },
//            {
//                "Name": "BodyStyle",
//                "Group": "Detalles",
//                "Value": "SUV",
//                "DisplayOnDetailsPage": true,
//                "IsKeyAttribute": false,
//                "IsDeleted": false
//            },
//            {
//                "Name": "FuelType",
//                "Group": "Detalles",
//                "Value": "Gas",
//                "DisplayOnDetailsPage": true,
//                "IsKeyAttribute": false,
//                "IsDeleted": false
//            },
//            {
//                "Name": "GearType",
//                "Group": "Detalles",
//                "Value": "Autom\\u00e1tica",
//                "DisplayOnDetailsPage": true,
//                "IsKeyAttribute": false,
//                "IsDeleted": false
//            },
//            {
//                "Name": "TipoVehiculo",
//                "Group": "Detalles",
//                "DisplayName": "Tipo Vehiculo",
//                "Value": "Autos, Camionetas y 4x4",
//                "DisplayOnDetailsPage": true,
//                "IsKeyAttribute": false,
//                "IsDeleted": false
//             },
//            {
//                "Name": "TipoCategoria",
//                "Group": "Detalles",
//                "DisplayName": "Tipo Categoria",
//                "Value": "Camioneta",
//                "DisplayOnDetailsPage": true,
//                "IsKeyAttribute": false,
//                "IsDeleted": false
//            },
//           {
//               "Name": "Aire Acondicionado",
//                "Group": "Equipamiento",
//                "DisplayName": "Aire Acondicionado",
//                "Value": "SI",
//                "DisplayOnDetailsPage": true,
//                "IsKeyAttribute": false,
//                "IsDeleted": false
//            },
//            {
//                "Name": "Espejos Electricos",
//                "Group": "Equipamiento",
//                "DisplayName": "Espejos Electricos",
//                "Value": "SI",
//                "DisplayOnDetailsPage": true,
//                "IsKeyAttribute": false,
//                "IsDeleted": false
//            },
//            {
//                "Name": "Frenos ABS",
//                "Group": "Equipamiento",
//                "DisplayName": "Frenos ABS",
//                "Value": "SI",
//                "DisplayOnDetailsPage": true,
//                "IsKeyAttribute": false,
//                "IsDeleted": false
//            },
//            {
//               "Name": "Airbag",
//               "Group": "Equipamiento",
//               "DisplayName": "Airbag",
//               "Value": "SI",
//               "DisplayOnDetailsPage": true,
//               "IsKeyAttribute": false,
//               "IsDeleted": false
//           },
//           {
//               "Name": "Cierre Centralizado",
//               "Group": "Equipamiento",
//               "DisplayName": "Cierre Centralizado",
//               "Value": "SI",
//               "DisplayOnDetailsPage": true,
//               "IsKeyAttribute": false,
//               "IsDeleted": false
//            },
//            {
//               "Name": "Catalítico",
//                "Group": "Equipamiento",
//                "DisplayName": "Catalítico",
//                "Value": "SI",
//                "DisplayOnDetailsPage": true,
//                "IsKeyAttribute": false,
//                "IsDeleted": false
//            },
//            {
//                "Name": "Llantas",
//                "Group": "Equipamiento",
//                "DisplayName": "Llantas",
//                "Value": "SI",
//                "DisplayOnDetailsPage": true,
//                "IsKeyAttribute": false,
//                "IsDeleted": false
//            },
//            {
//                "Name": "Alarma",
//                "Group": "Equipamiento",
//                "DisplayName": "Alarma",
//                "Value": "SI",
//                "DisplayOnDetailsPage": true,
//                "IsKeyAttribute": false,
//                "IsDeleted": false
//           },
//           {
//                "Name": "Radio",
//                "Group": "Equipamiento",
//                "DisplayName": "Radio",
//                "Value": "SI",
//                "DisplayOnDetailsPage": true,
//                "IsKeyAttribute": false,
//                "IsDeleted": false
//            },
//            {
//                "Name": "Cilindrada",
//                "Group": "Equipamiento",
//                "DisplayName": "Cilindrada",
//                "Value": "1500",
//                "DisplayOnDetailsPage": true,
//                "IsKeyAttribute": false,
//                "IsDeleted": false
//            }
//        ]
//    },
//    "Identifier": "40e4f8e8-a1f4-4748-bad0-5515f3861828",
//    "Type": "Car",
//    "ListingType": "Usado",
//    "SaleStatus": "In Stock",
//    "Registration": {
//    "Number": "ABCD12"
//    },
//    "Description": "",
//    "Colours": [
//        {
//       "Location": "Exterior",
//            "Generic": "Grey",
//            "Name": "Gris"
//        },
//        {
//        "Location": "Interior",
//           "Generic": "Grey",
//            "Name": "Gris"
//        }
//    ],
//   "OdometerReadings": [
//        {
//           "Value": 21968,
//           "UnitOfMeasure": "KM"
//       }
//   ],
//   "PriceList": [
//       {
//       "Currency": "MXN",
//        "Amount": 224700
//        }
//    ]
//}',
//  CURLOPT_HTTPHEADER => array(
//    'Content-Type: application/json',
//    'Authorization: Bearer eyJhbGciOiJSUzI1NiIsImtpZCI6IkIxNUYwQUQzQTc3NzQzRTY3RDU5NkFGNzVENjYwODRFOEM3NThCMEYiLCJ0eXAiOiJKV1QiLCJ4NXQiOiJzVjhLMDZkM1EtWjlXV3IzWFdZSVRveDFpdzgifQ.eyJuYmYiOjE2ODA1OTUyNDQsImV4cCI6MTY4MDU5ODg0NCwiaXNzIjoiaHR0cHM6Ly9pZC5zLmNvcmUuY3NuZ2xvYmFsLm5ldCIsImF1ZCI6Imh0dHBzOi8vaWQucy5jb3JlLmNzbmdsb2JhbC5uZXQvcmVzb3VyY2VzIiwiY2xpZW50X2lkIjoiNzJlNzEyNGMtNjQ0NS00MzZjLWIxMjAtY2NjNWUwMjAyYjJjIn0.qsprrpgA2RNWczDR64A63x3qMOGTQuoSDrJDW5N5UdUEI1KfXnKP3toiwDHgFblAzfCSlqgBwzsqmZyVntxZtPFwuwiBUgdyfKNprvXhN2Y5cOiF3_3XVUZfl_aNPlDieq49mep16CO1fQOww-ruTeM9qQkNAfhsNOOzTHyips42-DJ7VNuHk549sf1hBOJjIe6QOwW7yN2BEThlN6yWgBScLCC8TKVBzuuWowu_h3i2P-StylK6Th0gu7k_xy3wT6WTTP_gOfvOALBBTnw9IPtVqmoZl-p9LA4OwJkiL2WdsHaSywyVWbBCxdLxJ80fgGWHsmrYGHgq_EypeuyzYA'
//  ),
//));
//
//$response = curl_exec($curl);
//
//curl_close($curl);
//echo $response;