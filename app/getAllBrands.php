<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer 258|V3H1aJqlgkKnNVa7L7MxGoK1Xh2dYG4XQLhKk2Up'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$brands = json_decode($response, true)['data'];

function getBrandNameById($brands, $brandId) {
    foreach ($brands as $brand) {
        if ($brand['id'] == $brandId) {
            return $brand['name'];
        }
    }
    return 'Marca desconocida';
}