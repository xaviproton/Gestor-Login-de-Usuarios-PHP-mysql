<!-- Front del formulario de creaqcion de usuarios -->

<?php
include('connection.php');

$con = connection();

session_start();
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

//Codigo de usaurio incremental automatico, sumamos +1 al codigo mas grande que existaq en la BD
$sql = "SELECT MAX(codiusuari)  AS max_codigo FROM usuarios";

$result = $con->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $maxCodigo = $row['max_codigo'];
    $codig = ($maxCodigo !== null) ? $maxCodigo + 1 : 1;
}

?>
<!-- Formulario de alta de usuarios -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="icon" type="image/jpg" href="./images/logo_crudo.png" />
    <title>Gestió d'Usuaris</title>
</head>

<body style="height: 100vh;">
    <div id="myLogo" style="position: fixed; top: 10px; left: 10px;">
        <img src="./images/logo_crudo.png" style="width: 200px;">
    </div>
    <div class="login-container2 form-container2">
        <h2 id="titulo-creacion">Creació d'usuaris</h2>
        <form action="insert_user.php" method="POST">
            <div class="creacion_usuari">
                <div class="form-group2">
                    <input type="text" name="codiusuari" value="<?php echo $codig ?>" required autofocus>
                    <label>Codi Usuari*</label>
                </div>
                <div class="form-group2">
                    <input type="text" name="nomusuari" required>
                    <label>Nom Usuari*</label>
                </div>
                <div class="form-group2">
                    <input type="password" name="password" required>
                    <label>Password*</label>
                </div>
            </div>
            <div class="form-group2 form-group-acces">
                <label for="nivellacces">Nivell d'acces</label>
                <select name="nivellacces" id="nivellacces">
                    <option value="1">Admin</option>
                    <option value="2">Usuari</option>
                </select>
            </div>
            <div class="creacion-usuari2">
                <div class="form-group2">
                    <input type="date" name="dataalta" placeholder="yyyy/dd/mm">
                    <label>Data d'alta</label>
                </div>
                <div class="form-group2" id="dniSpecial">
                    <input type="text" name="dni">
                    <label>DNI</label>
                </div>
                <div class="form-group2">
                    <input type="text" name="email">
                    <label>Email</label>
                </div>
                <div class="form-group2">
                    <input type="text" name="telmobil">
                    <label>Teléfon</label>
                </div>
            </div>
            <div class="adminPwd" id="adminPwdContainer">
                <label>Password Admin </label>
                <input id="adminPwdInput" type="password" name="adminpass">
            </div>
            <div class="boton-crearUsuario">
                <button id="agregar" type="submit" value="Agregar Usuari">Crear Usuari</button>

            </div>

            <br>
            <div id="obligado">
                <p>Els camps marcats amb * son obligatoris</p>
            </div>
            <div class="opcionUsuario">
                <a id="opcion-logeo2" href="login.php">O entra amb un usuari registrat</a>
            </div>
        </form>
    </div>

    <div>
        <a id="botonAlta" href="usuaris_Registrats.php"> Usuaris Registrats </a>
    </div>
</body>

</html>