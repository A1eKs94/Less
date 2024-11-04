<?php

session_start();

$name = $_POST["name"];
$slug = $_POST["slug"];
$description = $_POST["description"];
$features = $_POST["features"];
$image = $_FILES["cover"]["tmp_name"] ?? '';
$brand_id = $_POST["brand_id"];

$newProduct = new Product();
$newProduct->addProduct($name, $slug, $description, $features, $image, $brand_id);

class Product
{

    function addProduct($name, $slug, $description, $features, $image, $brand_id)
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['token']) {
            echo "Error al crear el producto, token inválido.";
            
            return; 
        }        

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
                'features' => $features,
                'cover' => new CURLFile($image),
                'brand_id' => $brand_id
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 337|GzGcdu07geuD2hnudpxhuf3HFEr0CBvSKUEeHrUA'
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Error en la petición: ' . curl_error($curl);
            curl_close($curl);
            return; 
        }

        curl_close($curl);

        $response = json_decode($response);

        if (isset($response->code) && $response->code == 4) {
            header('Location: ../home');
            exit();
        } else {
            echo "Error al crear el producto: ";
        }
    }
}
