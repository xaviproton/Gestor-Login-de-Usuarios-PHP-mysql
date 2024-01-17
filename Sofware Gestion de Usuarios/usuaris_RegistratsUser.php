<!-- Archivo que contiene la pagina principal del programa donde se muestra nlos usuarios -->
<!-- Sección de Usuario -->

<?php
include('connection.php');



$con = connection();

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

if (isset($_SESSION['nomusuari'])) {
    $nomusuari = $_SESSION['nomusuari'];
} else {

    header("Location: login.php");
    exit();
}




$sql = "SELECT * FROM usuarios";
$query = mysqli_query($con, $sql);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="icon" type="image/jpg" href="./images/logo_crudo.png" />
    <title><?php echo $_SESSION['nomusuari']; ?></title>
    <script>
       

         // Funciones cartel de cerrar sesion
         function cambiarEstilo() {
            let cartel = document.getElementById("cartel");

            cartel.style.visibility = "visible";
           
        }
        function cambiarEstilo2() {
            let cartel = document.getElementById("cartel");

            cartel.style.visibility = "hidden";
           
        }
    </script>
</head>

<body>

<!-- Cartel de cierre de sesion__________ -->
<div id="cartel" class="cartelCerrar">
        <div>
            <h3>Estas segur que vols tancar sessió?</h3>
        </div>
        <div class="cartelButton">
            <form id="btn-conf" action="cerrar_sesion.php" method="post">
                <button type="submit"  class="confirmBtn">Confirmar</button>
                <button id="botonCancelar" class="cancelBtn" onclick=" cambiarEstilo2()" type="button">Cancelar</button>
            </form>
        </div>
    </div>

    <div class="bienvenidaContainer">
        <div id="pagina-bienvenida">
        <div id="bienvenida">
                <h1>Benvingut <?php echo $_SESSION['nomusuari']; ?></h1>
            </div>
           
            <div id="mylogowanted" id="myLogo" style="position: fixed; top: 10px; left: 10px;">
                <img src="./images/logo_crudo.png" style="width: 200px;">
            </div>

            <div class="tipuUser">
                <h2>Usuari</h2>
            </div>

        </div>
        <div class="botones-bienvenida">
           
        <div class="enlace-cerrar">
                <div>
                    <button onclick=" cambiarEstilo()" type="submit">Tancar Sessió</button>
                    
                </div>
            </div>
        </div>
        <hr>
        <h2 id="titulo2">Usuaris Registrats</h2>
        <div class="usuarisRegistrats">
           
            <table class="tablaMostrarDatos">
                <thead>
                    <tr>
                        <th>Num Entrada</th>
                        <th>Codi d'Usuari</th>
                        <th>Nom</th>
                        <th>Nivell d'accés</th>
                        <th>Data d'alta</th>
                        <th>DNI</th>
                        <th>@Email</th>
                        <th>Telèfon mòbil</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>

                </thead>

                <tbody>
                    <?php while ($row = mysqli_fetch_array($query)) : ?>
                        <?php
                        $nivellacces = $row['nivellacces'];
                        $accesType = ($nivellacces == 1) ? "Admin" : (($nivellacces == 2) ? "Usuari" : "Desconocido");
                        $newDate = date("d/m/Y", strtotime($row['dataalta']));
                        ?>
                        <tr id="ancla">
                            <td><?= $row['ID'] ?></td>
                            <td><?= $row['codiusuari'] ?></td>
                            <td><?= $row['nomusuari'] ?></td>
                            <td><?= $accesType ?></td>
                            <td><?= $newDate ?></td>
                            <td><?= $row['dni'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['telmobil'] ?></td>
                            <td>
                                <p>Solo Admin</p>
                            </td>
                            <td>
                                <p>SuperAdmin</p>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>