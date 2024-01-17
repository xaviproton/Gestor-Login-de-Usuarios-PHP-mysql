<?php
session_start();

include('connection.php');
include('log.php');

$nomusuari = $_SESSION['nomusuari'];

if (isset($_GET["funcion"])) {

    $connect = connection();
    $tableName = 'usuarios';
    $timestamp = date('Y-m-d_H-i-s');
    $backupFile = "C:/Users/Usuari/Desktop/CopiasBD/backup-{$timestamp}_{$nomusuari}.sql";

    // Obtener estructura de la tabla
    $structureQuery = "SHOW CREATE TABLE $tableName";
    $structureResult = mysqli_query($connect, $structureQuery);

    if (!$structureResult) {
        echo mysqli_error($connect);
        exit();
    }

    $structureRow = mysqli_fetch_row($structureResult);
    $structure = $structureRow[1];

    // Obtener datos de la tabla
    $dataQuery = "SELECT * FROM $tableName";
    $dataResult = mysqli_query($connect, $dataQuery);

    if (!$dataResult) {
        echo mysqli_error($connect);
        exit();
    }

    $data = array();
    while ($row = mysqli_fetch_assoc($dataResult)) {
        $data[] = $row;
    }

    // Guardar estructura y datos en el archivo de copia de seguridad
    file_put_contents($backupFile, $structure . ";\n\n");

    foreach ($data as $row) {
        $values = array_map('addslashes', array_values($row));
        $values = implode("','", $values);
        // $linea = "$id".","."$codi".","."$nombre";
        $insertQuery = "INSERT INTO $tableName VALUES ('$values');";
        file_put_contents($backupFile, $insertQuery . "\n", FILE_APPEND);
    }

    mysqli_close($connect);

    // Resto de tu código...
    $mensaje = "Has fet amb ÉXIT una copia de la base de dades ";
    echo "<div style='width:100%; 
                  height: 100%;
                  display: flex;
                  justify-content: center;
                  align-items:center'>
      <div id='mensaje-alerta' style='
                    border: 2px solid #ccc;
                    padding: 20px; 
                    background-color: var(--colorblue1);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-direction: column;
                    border: 1px solid #ccc;
                    padding: 10px;
                    background-color: rgba(55, 136, 242, 0.541);
                    border-radius: 10px;
                    border: 1px solid #green;
                    width:45%;
                    height: 25%;
                    font-size:20px;
                    font-weight:bold;
                    text-align: center;
                    margin-bottom: 30rem;
                    '>
<p>$mensaje</p>
<button onclick=\"window.location='usuaris_Registrats.php'\" 
style='width: 4rem; height: 2rem; background-color: #1fc64e'
>OK</button>
<button onclick=\"window.location='restore.php?file=$backupFile'\" 
style='width: 8rem; height: 2rem; background-color: #ffc107; margin-top: 1rem;'
>Restaurar</button>
</div>
</div>";
    writeToLog("Copia de la BD realizada", $nomusuari);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>backup BD</title>
</head>

<body>
    <div class="backupStyle">
        <h2>Copia de Seguretat de la Base de dades</h2>
        <form method="GET" action="backUp.php">
            <button name="funcion" value="5" type="submit" id="backup-aceptar">Copiar BD</button>
            <button type="button" id="backup-cancelar">Cancelar</button>
        </form>
    </div>

    <script>
        document.getElementById('backup-cancelar').onclick = function() {
            location.href = 'usuaris_Registrats.php';
        };
    </script>
</body>

</html>
