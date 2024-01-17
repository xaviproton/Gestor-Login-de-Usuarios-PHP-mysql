<!-- Archivo de BackEnd con la configuración de conexión al servidor -->

<?php

function connection()
{
    $host = "localhost";
    $user = "root";
    $pass = "";
    $bd = "control";

    try {
        $connect = mysqli_connect($host, $user, $pass);

        if (!$connect) {
            throw new Exception('Error al conectar con la base de datos: ' . mysqli_connect_error());
           
        }

        mysqli_select_db($connect, $bd);
       
        return $connect;
    } catch (Exception $e) {

        die('Error: ' . $e->getMessage());
    }
}
