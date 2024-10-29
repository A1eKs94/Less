<?php

$name = $_POST["name"];
$slug = $_POST["slug"];
$description = $_POST["description"];
$features = $_POST["features"];

$newProduct = new Product();
$newProduct->addProduct($name, $slug, $description, $features); 

class Product
{

    function addProduct($name, $slug, $description, $features)
    {
        echo "<script>console.log('algo' );</script>";
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
            'name' => $name, 
            'slug' => $slug, 
            'description' => $description, 
            'features' => $features),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 13|TJVmwZdhJoQzsqsVziB7MnreYhmc2zPMPXM9ww61'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        $response = json_decode($response);


        
        if (isset($response->code) && $response->code == 4) {
                header("location: ../home.php");
                exit(); 
            } else {
                echo "Error al añadir producto";
            }
        
    }
}
