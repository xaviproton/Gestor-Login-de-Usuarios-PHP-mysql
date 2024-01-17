<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Restaurar BD</title>
</head>

<body>
    <div class="backupStyle">
        <h3>Restaurar copia de seguridad de la base de datos</h3>
        <form method="POST" action="restaurarbackUpBack.php">
            <select id="backupSelect" name="backupFile">
                <?php
                $backups = glob('C:\Users\Usuari\Desktop\CopiasBD/*.sql');
                foreach ($backups as $backup) {
                    echo '<option value="' . $backup . '">' . $backup . '</option>';
                }
                ?>
            </select>
            <button type="submit" id="restorebackup-aceptar" value="Restaurar">Restaurar</button>
            <button type="button" id="restorebackup-cancelar" onclick="cCancelar()">Cancelar</button>
        </form>
    </div>

    <script>
      document.getElementById("restorebackup-aceptar").addEventListener("click", function() {
    var backupFile = document.getElementById("backupSelect").value;
    var respuesta = confirm("¿Estás seguro de que quieres restaurar la copia de seguridad '" + backupFile + "'?");
    
    if (respuesta) {
        console.log("Restauración confirmada. Enviando formulario...");
        document.forms[0].submit();  
    } else {
        console.log("Restauración cancelada.");
        return false; 
    }
});

    </script>
</body>

</html>