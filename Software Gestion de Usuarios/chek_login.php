<!-- BackEnd, se encarga de realizar la comprobación de login de usuario -->

<?php
include('connection.php');
include('log.php');
$con = connection();


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

//Este condicional comrueba si REQUEST_METHOD, tiene almacenado un metodo POST, si es asi, 
//comprueba con isset(funcion que comprueba si una variable esta definida y no es nula),
//comprueba si en la solicitud POST se incluyó el parámetro 'cerrar_sesion'.


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cerrar_sesion'])) {

        session_destroy();
        exit();
    }

    $nomusuari = $_POST['username'];
    $password = $_POST['password'];
//Hacemos la consulta de password y usaurio
    $sql = "SELECT * FROM usuarios WHERE nomusuari = '$nomusuari' AND password = '$password'";
//si hay coincidencia, hacemos la comprobación del nivel de acceso del usaurio logeado y lanzamos unmensjae diferente  segun su nivel de acceso
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['nomusuari'] = $nomusuari;
        $row = $result->fetch_assoc();
        $nivellacces_usuario = $row['nivellacces'];

        if ($nivellacces_usuario == 0) {
            $mensaje = "T'has identificat correctament com Super Administrador. Benvingut/a  " . $nomusuari;
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
          </div>
          </div>";
            writeToLog("Session Iniciada", $nomusuari);
            exit();
        } else if ($nivellacces_usuario == 2) {
            $mensaje = "T'has identificat correctament con Usuari. Benvingut/a " . $nomusuari;
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
                                background-color: rgba(55, 136, 242, 0.541);
                                border-radius: 10px;
                                border: 1px solid #green;
                                width:35%;
                                height: 15%;
                                font-size:20px;
                                text-align: center;
                                margin-bottom: 30rem;
                                '>
            <p>$mensaje</p>
            <button onclick=\"window.location='usuaris_RegistratsUser.php'\" 
            style='width: 4rem; height: 2rem; background-color: #1fc64e'
            
            
            >OK</button>
          </div>
          </div>";
            writeToLog("Session Iniciada", $nomusuari);
            exit();
        } else {
            $mensaje = "T'has identificat correctament com Administrador. Benvingut/a " . $nomusuari;
            echo "<div style='width:100%; 
                              height: 100%;
                             
                              display: flex;
                              justify-content: center;
                              align-items:center'>
            <div id='mensaje-alerta' style='
                                border: 2px solid #ccc;
                                padding: 20px; 
                                background-color: #0c9af2;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                flex-direction: column;
                                border: 1px solid #ccc;
                                padding: 10px;
                                background-color: rgba(55, 136, 242, 0.541);
                                border-radius: 10px;
                                border: 1px solid #green;
                                width:35%;
                                height: 15%;
                                font-size:20px;
                                text-align: center;
                                margin-bottom: 30rem;
                                '>
            <p>$mensaje</p>
            <button onclick=\"window.location='usuaris_RegistratsAdmin.php'\" 
            style='width: 4rem; height: 2rem; background-color: #098b18'
            
            
            >OK</button>
          </div>
          </div>";
            writeToLog("Session Iniciada", $nomusuari);
            exit();
        }
    } else {
        // Failed login
        writeToLog("Error al iniciar sesion", $nomusuari);
        header("Location: ./error/errorLogin.php");
        exit();
    }
}
