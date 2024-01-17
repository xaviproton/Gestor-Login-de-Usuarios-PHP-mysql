<!-- BackEnd con la funcionalidad de eliminar usuarios -->

<?php
include("connection.php");
include('log.php');
$con = connection();
session_start();
$ID = $_GET["ID"];

//La variable _GET Se verifica si la variable 'confirm' está presente en la URL
//  (a través de la superglobal $_GET) y si su valor es '1'.
//Si es asi, el DELETE ala BD usando la ID de usaurio como referencia de datos
if (isset($_GET['confirm']) && $_GET['confirm'] == '1') {
    $sql = "DELETE FROM usuarios WHERE ID='$ID'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        Header("Location: usuaris_Registrats.php");
        
    } else {
        writeToLog("Error al eliminar Usuario", $_SESSION['nomusuari']);
    }
} else {
    echo "No se ha  confirmado para eliminar el usuario.";
}
writeToLog("User Deleted", $_SESSION['nomusuari']);
