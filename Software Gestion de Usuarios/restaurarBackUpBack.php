<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include('connection.php');
include('log.php');

function restaurarBD()
{
    $connect = connection();
    $nomusuari = $_SESSION['nomusuari'];
    $backupFile = $_POST['backupFile'];

    if (!file_exists($backupFile)) {
        echo "No se ha encontrado el archivo de copia de seguridad";
        return;
    }

    $file = fopen($backupFile, 'r');

    if ($file) {
        $error = false;

        while (($line = fgets($file)) !== false) {
            $result = mysqli_query($connect, $line);

            if (!$result) {
                echo "Error en la consulta: " . mysqli_error($connect);
                $error = true;
                break;
            }
        }

        fclose($file);


        if (!$error) {
            writeToLog("Copia de la BD restaurada", $nomusuari);
            mysqli_close($connect);
            header('Location: usuaris_Registrats.php');
        } else {
            echo "Error al ejecutar consultas";
        }
    } else {
        echo "Error al abrir el archivo de copia de seguridad: " . error_get_last()['message'];
    }
}


if (isset($_POST['backupFile'])) {
    restaurarBD();
}
