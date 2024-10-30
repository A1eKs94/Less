<?php

$name = $_POST["name"] ?? '';
$slug = $_POST["slug"] ?? '';
$description = $_POST["description"] ?? '';
$features = $_POST["features"] ?? '';
$id = $_POST["id"] ?? '';

updateProduct($name, $slug, $description, $features, $id);

function updateProduct($name, $slug, $description, $features, $id) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => http_build_query([
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'features' => $features,
            'id' => $id
        ]),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer 13|TJVmwZdhJoQzsqsVziB7MnreYhmc2zPMPXM9ww61',
        ),
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    
    $response = json_decode($response);

    header("location: ../home.php");
    if (isset($response->code) && $response->code == 4) {
        exit(); 
    } else {
        echo "Error al editar producto: ";
    }
}
