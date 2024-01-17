<!-- Archivo FrontEnd de formulario de logn de usaurios -->

<?php
//Invocamos el archivo conla configuración de la conexion al servidor 
//y el archivo  con la funcion de log y le asignomla v ariable con
include('connection.php');
include('log.php');
session_start();
$con = connection();


if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
  writeToLog("Error al fer la conexió amb el servidor: " . $con->error, $nomusuari);
}

//comprobamos el nombre y password de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nomusuari = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM usuarios WHERE nomusuari = '$nomusuari' AND password = '$password'";
  $result = $con->query($sql);


  if ($result === false) {
    writeToLog("Error al fer la consuñlta SQL: " . $con->error, $nomusuari);
    header("Location: ./error.php");
    exit();
  }

//Si tanto el password y la contraseña son correctos, otorgamos el nombre del usuario a la variable de SESSION
//Si es asi, redirigimos  la paguina de usuarios con "header"
  if ($result->num_rows > 0) {

    writeToLog("Logging correcto", $nomusuari);

    $_SESSION['nomusuari'] = $nomusuari;
    header("Location: usuaris_Registrats.php");
    exit();
  } else {

    writeToLog("Error en el intent d'inici de sessió", $nomusuari);

    header("Location: login.php");
    exit();
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./CSS/style.css">
  <link rel="icon" type="image/jpg" href="./images/logo_crudo.png" />
  <script src="https://kit.fontawesome.com/cf4b7d566f.js" crossorigin="anonymous"></script>
  <title>Login</title>
</head>

<body>

  <div class="login-container form-container">
    <h2>Iniciar Sessió</h2>
    <form method="post" action="chek_login.php">
      <div class="form-group">
        <input class="inicioFormulari" type="text" name="username" required autofocus />
        <label class="inicioFormulari2" for="text">Nom D'usuari</label>
      </div>

      <div class="form-group">
        <input class="inicioFormulari" type="password" name="password" id="password" required />
        <label for="password">Password</label>
        <button type="button" class="password-toggle" onclick="verPassword(this)">
          <i class="fas fa-eye"></i>
        </button>
      </div>
      <button type="submit" value="send" id="iniciarSesion">Iniciar Sessió</button>
    </form>

  </div>
 

  <!-- SCript con Js para cambiar el la visivilidad del password -->
  <script>
    function verPassword(button) {
      const passwordInput = document.getElementById("password");
      const type =
        passwordInput.getAttribute("type") === "password" ?
        "text" :
        "password";
      passwordInput.setAttribute("type", type);
      button.classList.toggle("active");
      const icon = button.querySelector("i");
      const newIconClass =
        type === "password" ? "fas fa-eye" : "fas fa-eye-slash";
      icon.className = newIconClass;
    }
  </script>
</body>

</html>
