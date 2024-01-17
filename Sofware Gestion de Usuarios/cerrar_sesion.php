<!-- BackEnd de cerrar sesion de usaurio -->

<?php
include('log.php');
session_start();

session_destroy();

$nomusuari = $_SESSION['nomusuari'];

writeToLog("Session cerrada por ", $nomusuari);


header("Location: index.php");
exit();

?>