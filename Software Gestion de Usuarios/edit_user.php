<!-- BackEnd con la funcionalidad de editar usuarios -->

<?php

include("connection.php");
include('log.php');
$con = connection();
session_start();
$ID = $_POST["ID"];

// datos de usaurios ya creados
$codiusuari = $_POST['codiusuari'];
$nomusuari = $_POST['nomusuari'];
$password = $_POST['password'];
$nivellacces = $_POST['nivellacces'];
$dataalta = $_POST['dataalta'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$telmobil = $_POST['telmobil'];


// Consulta UPDATE de edición de usuarios
$sql = "UPDATE usuarios SET 
            codiusuari='$codiusuari',
            nomusuari='$nomusuari',
            password='$password',
            nivellacces='$nivellacces',
            dataalta='$dataalta',
            dni='$dni',
            email='$email',
            telmobil='$telmobil' 
        WHERE ID='$ID'    
            ";

$nomusuariAD = $_SESSION['nomusuari'];
$query = mysqli_query($con, $sql);

// Consulta SELECT para comprobar el mnivel de acceso 
$sql = "SELECT nivellacces FROM usuarios WHERE nomusuari = '$nomusuariAD'";
$query = mysqli_query($con, $sql);

// Una vez recogido el tipo de acceso que tiene el usaurio,
//  segun el resultado nos devuelve a la seccion del programa que corresponde
// segun su nivel de acceso  

if ($query) {
   
    $resultado = mysqli_fetch_assoc($query);

    if ($resultado) {
      
        $nivellacces = $resultado['nivellacces'];
            echo $nivellacces;
        switch ($nivellacces) {
            case "0":
                Header("Location: usuaris_Registrats.php");
                break;
            case "1":
                Header("Location: usuaris_RegistratsAdmin.php");
                break;
            case "2":
                Header("Location: usuaris_RegistratsUser.php");
                break;
            default:
                Header("Location: login.php");
                break;
        }
    } else {
        writeToLog("User $nomusuari No trobat per el usuari", $_SESSION['nomusuari']);
        Header("Location: login.php");
    }
} else {
   
    echo "Error en la consulta: " . mysqli_error($con);
}
writeToLog("User $nomusuari Modified", $_SESSION['nomusuari']);
