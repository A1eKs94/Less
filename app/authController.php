<?php

    session_start();

    $email = $_POST["email"];
    $password = $_POST["password"];

    $newUser = new User();

    $newUser->login($email, $password);


    class User{

        function login($email, $password){
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('email' => $email, 'password' => $password),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $response = json_decode($response);

            if (isset($response->code) && $response->code == 2) {
                $_SESSION['data'] = $response;
                header('Location: ../home.html');
                exit(); 
            } else {
                echo "Login failed. Please check your credentials.";
            }
        }
    }

?>
