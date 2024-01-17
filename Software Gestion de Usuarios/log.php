<!--  BackEnd de Archivo de log del programa -->

<?php
//Funcion de log que escribe en log.txt lo mque va sucedioendo en el programa 
function writeToLog($action,$nomusuari) {
    $logFile = 'log.txt';
    $timestamp = date("Y-m-d H:i:s");
    $logMessage = "$timestamp - $action by $nomusuari\n";

    // Agregar la entrada al archivo de log
    file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
}


?>
