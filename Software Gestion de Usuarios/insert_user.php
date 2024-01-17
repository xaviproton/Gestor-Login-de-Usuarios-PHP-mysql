<!-- Archivo de backend con la logica para crear usuarios -->

<?php
include('connection.php');
include('log.php');
$con = connection();

session_start();

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Comprobamos la contraseña de superusuario 
if (isset($_SESSION['nomusuari'])) {
    $nomusuari = $_SESSION['nomusuari'];

    $query = "SELECT adminpass FROM usuarios WHERE nomusuari = '$nomusuari'";
    $result = mysqli_query($con, $query);

    if ($result) {

        if ($row = mysqli_fetch_assoc($result)) {
            $passwordDelUsuarioLogueado = $row['adminpass'];
        }
    }
}

// Generamos un codigo automatico al acceder a crear un nuevo usuario, simpre +1 al codigo mas alto
$sql = "SELECT MAX(codiusuari)  AS max_codigo FROM usuarios";

$result = $con->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $maxCodigo = $row['max_codigo'];
    $codig = ($maxCodigo !== null) ? $maxCodigo + 1 : 1;
} else {

    die("Error en la consulta: " . $con->error);
}

$nomusuari = $_POST['nomusuari'];
$password = $_POST['password'];
$nivellacces = $_POST['nivellacces'];
$dataalta = $_POST['dataalta'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$telmobil = $_POST['telmobil'];

$adminpass = $_POST['adminpass'];

// Si el adminpass es correcto, podemos introducir el nuevo usaurio en la BD

if ($adminpass == $passwordDelUsuarioLogueado) {

    $sql = "INSERT INTO usuarios (codiusuari, nomusuari, password, nivellacces, dataalta, dni, email, telmobil)
        SELECT '$codig', '$nomusuari', '$password', '$nivellacces', '$dataalta', '$dni', '$email', '$telmobil'
        FROM dual
        WHERE NOT EXISTS (SELECT 1 FROM usuarios WHERE codiusuari = '$codig')";

    $query = mysqli_query($con, $sql);

    if ($query && mysqli_affected_rows($con) > 0) {

        writeToLog("User $nomusuari Created ", $_SESSION['nomusuari']);
        Header("Location: usuaris_Registrats.php");
    } else {

        $mensaje = "Debes introducir un código de usuario que no exista ";
        echo "<div style='width:100%; 
                      height: 100%;
                      display: flex;
                      justify-content: center;
                      align-items:center'>
    <div id='mensaje-alerta' style='
                        border: 2px solid #ccc;
                        padding: 20px; 
                        background-color: #f9f9f9;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-direction: column;
                        border: 1px solid #ccc;
                        padding: 10px;
                        background-color: #1f9cc6;
                        border-radius: 10px;
                        border: 1px solid #green;
                        width:50%;
                        height: 15%;
                        font-size:20px
                        text-align: center;
                        '>
    <p>$mensaje</p>
    <button onclick=\"window.location='usuaris_Registrats.php'\" 
    style='width: 4rem; height: 2rem; background-color: #1fc64e'
    
    >OK</button>
  </div>
  </div>";
        writeToLog("Error al registrar usuario con el código repetido $codig", $_SESSION['nomusuari']);
    }
} else {
    $mensaje2 = "Contraseña de administrador incorrecta.";
    echo "<div style='width:100%; 
    height: 100%;
    display: flex;
    justify-content: center;
    align-items:center'>
<div id='mensaje-alerta' style='
      border: 2px solid #ccc;
      padding: 20px; 
      background-color: #f9f9f9;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      border: 1px solid #ccc;
      padding: 10px;
      background-color: #1f9cc6;
      border-radius: 10px;
      border: 1px solid #green;
      width:50%;
      height: 15%;
      font-size:20px
      text-align: center;
      '>
<p>$mensaje2</p>
<button onclick=\"window.location='altaUsuaris.php'\" 
style='width: 4rem; height: 2rem; background-color: #1fc64e'

>OK</button>
</div>
</div>";
    writeToLog("Error al ingresar la contraseña", $_SESSION['nomusuari']);
    exit;
}
