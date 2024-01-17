<!-- Archivo de FrontENd de edición de usuarios -->

<?php
include('connection.php');
$con = connection();

$ID = $_GET['ID'];

$sql = "SELECT * FROM usuarios WHERE ID='$ID'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="icon" type="image/jpg" href="./images/logo_crudo.png" />
    <title>Modificar usuario</title>
</head>

<body>
    <header>
        <div class="menu">
            <div class="enlaces">
                <a href="index.php">Inici</a>
                <a href="altaUsuaris.php">Crear Usuaris</a>
                <a href="usuaris_Registrats.php">Usuaris</a>
            </div>

        </div>
    </header>
    <div class="login-container2 form-container2">
        <h2>Modificar Usuaris</h2>
        <form action="edit_user.php" method="POST">


            <div class="creacion_usuari">
                <input type="hidden" name="ID" value="<?= $row['ID'] ?>">
                <div class="formUpdate1">
                    <div class="form-group2">
                        <input type="text" name="codiusuari" value="<?= $row['codiusuari'] ?>">
                        <label>Codi Usuari</label>
                    </div>
                    <div class="form-grup2">
                        <input type="text" name="nomusuari" value="<?= $row['nomusuari'] ?>">
                        <label>Nom Usuari</label>
                    </div>
                    <div class="form-grup2">
                        <input type="text" name="password" value="<?= $row['password'] ?>">
                        <label>Password*</label>
                    </div>
                </div>
                <div class="formUpdate1">
                    <div class="form-group2 form-group-acces2">
                        <label for="nivellacces">Nivell d'acces</label>
                        <select name="nivellacces" id="nivellacces">
                            <option value="1" <?= ($row['nivellacces'] == 1) ? 'selected' : '' ?>>Admin</option>
                            <option value="2" <?= ($row['nivellacces'] == 2) ? 'selected' : '' ?>>Usuari</option>
                        </select>
                    </div>

                    <div class="form-group2">
                        <input class='dni' type="date" name="dataalta" value="<?= $row['dataalta'] ?>">
                        <label>Data d'alta</label>
                    </div>
                    <div class="form-group2" id="dniSpecial2">
                        <input type="text" name="dni" value="<?= $row['dni'] ?>">
                        <label>DNI</label>
                    </div>
                </div>
                <div class="formUpdate1">
                    <div class="form-group2">
                        <input type="text" name="email" value="<?= $row['email'] ?>">
                        <label>Email</label>
                    </div>
                    <div class="form-group">
                        <input type="text" name="telmobil" value="<?= $row['telmobil'] ?>">
                        <label>Teléfon</label>
                    </div>
                </div>
                <div class="update">
                    <input type="submit" id="agregarButton2" value="Actualitzar">
                    <button id="cancelarModiify" >Cancelar</button>
                </div>

            </div>
        </form>
    </div>
 
</body>

</html>