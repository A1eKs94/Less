<?php

session_start();

$id = $_POST["id"];

deleteProduct($id);
function deleteProduct($id)
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . $id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'DELETE',
    CURLOPT_HTTPHEADER => array(
      'Authorization: Bearer 337|GzGcdu07geuD2hnudpxhuf3HFEr0CBvSKUEeHrUA'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);

  header("location: ../home");
}
