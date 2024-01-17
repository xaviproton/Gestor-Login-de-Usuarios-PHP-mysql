<!-- Archivo que contiene la pagina principal del programa donde se muestra nlos usuarios -->
<!-- Sección de Administrador -->

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
        function confirmarEliminacion(ID) {

            var modal = document.getElementById("myModal");

            modal.style.display = "block";


            document.getElementById("confirmBtn").onclick = function() {
                window.location.href = 'delete_user.php?ID=' + ID + '&confirm=1';
            };

            document.getElementById("cancelBtn").onclick = function() {

                modal.style.display = "none";
                return false;
            };
        }


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
            <h3>Estàs segur que vols tancar sessió?</h3>
        </div>
        <div class="cartelButton">
            <form action="cerrar_sesion.php" method="post">
                <div class="modal-content2">
                    <button type="submit" class="confirmBtn">Confirmar</button>
                    <button id="botonCancelar" class="cancelBtn" onclick=" cambiarEstilo2()" type="button">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cartel de cancelar -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <p>Estàs segur que vols eliminar aquest usuari?</p>
            <div class="modal-content-btn">
                <button id="confirmBtn" class="confirmBtn">Sí</button>
                <button id="cancelBtn" class="cancelBtn">Cancelar</button>
            </div>
        </div>
    </div>

    <!-- Bienvenida con nombre usuario y logo -->
    <div class="bienvenidaContainer">
        <div id="pagina-bienvenida">
            <div id="bienvenida">
                <h1>Benvingut <?php echo $_SESSION['nomusuari']; ?></h1>
            </div>
            <div id="mylogowanted" id="myLogo" style="position: fixed; top: 10px; left: 10px;">
                <img src="./images/logo_crudo.png" style="width: 200px;">
            </div>
            <div class="tipuUser">
                <h2>Administrador</h2>
            </div>
        </div>

        <div class="botones-bienvenida">
            <div class="enlace-crear">
                <a href="altaUsuaris.php?user=<?php echo $_SESSION['nomusuari']; ?>">Crear Usuaris</a>
            </div>
            <div class="enlace-cerrar">
                <div>
                    <button onclick=" cambiarEstilo()" type="submit">Tancar Sessió</button>

                </div>
            </div>
        </div>
        <!-- Carterl de cancelar -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <p>¿Estás seguro de que quieres eliminar este usuario?</p>
                <button id="confirmBtn">Sí</button>
                <button id="cancelBtn">Cancelar</button>
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
                        <th></th>
                        <th></th>
                    </tr>

                </thead>

                <tbody>
                    <?php while ($row = mysqli_fetch_array($query)) : ?>
                        <?php
                        $nivellacces = $row['nivellacces'];
                        $accesType = ($nivellacces == 1) ? "Admin" : (($nivellacces == 2) ? "Usuari" : "SuperAdmin");
                        $newDate = date("d/m/Y", strtotime($row['dataalta']));
                        ?>
                        <tr>
                            <td><?= $row['ID'] ?></td>
                            <td><?= $row['codiusuari'] ?></td>
                            <td><?= $row['nomusuari'] ?></td>
                            <td><?= $accesType ?></td>
                            <td><?= $newDate ?></td>
                            <td><?= $row['dni'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['telmobil'] ?></td>
                            <td><a href="update.php?ID=<?= $row['ID'] ?>" class="users-table-edit">Editar</a></td>
                            <td><p>Solo SuperAdmin</p></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>