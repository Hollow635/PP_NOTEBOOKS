<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$name = $_SESSION['name'];

$computers = [
    'A' => [
        ['id' => 'A01', 'status' => 'available', 'message' => 'Esta notebook se encuentra disponible, si desea pedirla presione en Pedir.'],
        ['id' => 'A02', 'status' => 'available', 'message' => 'Esta notebook se encuentra disponible, si desea pedirla presione en Pedir.'],
        ['id' => 'A03', 'status' => 'maintenance', 'message' => 'Esta notebook se encuentra en mantenimiento, no está disponible hasta nuevo aviso :('],
        ['id' => 'A04', 'status' => 'available', 'message' => 'Esta notebook se encuentra disponible, si desea pedirla presione en Pedir.'],
        ['id' => 'A05', 'status' => 'available', 'message' => 'Esta notebook se encuentra disponible, si desea pedirla presione en Pedir.'],
        ['id' => 'A06', 'status' => 'maintenance', 'message' => 'Esta notebook se encuentra en mantenimiento, no está disponible hasta nuevo aviso :('],
        ['id' => 'A07', 'status' => 'available', 'message' => 'Esta notebook se encuentra disponible, si desea pedirla presione en Pedir.'],
        ['id' => 'A08', 'status' => 'unavailable', 'message' => 'Esta notebook se usando justo ahora, por favor elija otra.'],
        ['id' => 'A09', 'status' => 'available', 'message' => 'Esta notebook se encuentra disponible, si desea pedirla presione en Pedir.'],
        ['id' => 'A10', 'status' => 'maintenance', 'message' => 'Esta notebook se encuentra en mantenimiento, no está disponible hasta nuevo aviso :('],
    ],
    'B' => [
        ['id' => 'B01', 'status' => 'unavailable', 'message' => 'Esta notebook no está disponible, por favor elija otra.'],
        ['id' => 'B02', 'status' => 'maintenance', 'message' => 'Esta notebook se encuentra en mantenimiento, no está disponible hasta nuevo aviso :('],
        ['id' => 'B03', 'status' => 'available', 'message' => 'Esta notebook se encuentra disponible, si desea pedirla presione en Pedir.'],
        ['id' => 'B04', 'status' => 'available', 'message' => 'Esta notebook se encuentra disponible, si desea pedirla presione en Pedir.'],
        ['id' => 'B05', 'status' => 'maintenance', 'message' => 'Esta notebook se encuentra en mantenimiento, no está disponible hasta nuevo aviso :('],
        ['id' => 'B06', 'status' => 'available', 'message' => 'Esta notebook se encuentra disponible, si desea pedirla presione en Pedir.'],
        ['id' => 'B07', 'status' => 'unavailable', 'message' => 'Esta notebook no está disponible, por favor elija otra.'],
        ['id' => 'B08', 'status' => 'maintenance', 'message' => 'Esta notebook se encuentra en mantenimiento, no está disponible hasta nuevo aviso :('],
        ['id' => 'B09', 'status' => 'unavailable', 'message' => 'Esta notebook no está disponible, por favor elija otra.'],
        ['id' => 'B10', 'status' => 'unavailable', 'message' => 'Esta notebook no está disponible, por favor elija otra.'],
    ],
    'C' => [
        ['id' => 'C01', 'status' => 'available', 'message' => 'Esta notebook no está disponible, por favor elija otra.'],
        ['id' => 'C02', 'status' => 'unavailable', 'message' => 'Esta notebook no está disponible, por favor elija otra'],
        ['id' => 'C03', 'status' => 'available', 'message' => 'Esta notebook se encuentra disponible, si desea pedirla presione en Pedir.'],
        ['id' => 'C04', 'status' => 'available', 'message' => 'Esta notebook se encuentra disponible, si desea pedirla presione en Pedir.'],
        ['id' => 'C05', 'status' => 'maintenance', 'message' => 'Esta notebook se encuentra en mantenimiento, no está disponible hasta nuevo aviso :('],
        ['id' => 'C06', 'status' => 'available', 'message' => 'Esta notebook se encuentra disponible, si desea pedirla presione en Pedir.'],
        ['id' => 'C07', 'status' => 'available', 'message' => 'Esta notebook está disponible, si desea pedirla presione en Pedir.'],
        ['id' => 'C08', 'status' => 'maintenance', 'message' => 'Esta notebook se encuentra en mantenimiento, no está disponible hasta nuevo aviso :('],
        ['id' => 'C09', 'status' => 'unavailable', 'message' => 'Esta notebook no está disponible, por favor elija otra.'],
        ['id' => 'C10', 'status' => 'maintenance', 'message' => 'Esta notebook se encuentra en mantenimiento, no esta disponible hasta nuevo aviso :(.'],
    ],
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio Principal</title>
    <link rel="stylesheet" href="estilos/styles.css">
    <link rel="icon" href="imagenes/logo.ico">
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <img src="imagenes/OK.png" alt="Escudo" class="logo"> 
        </div>
        <nav class="menu">
            <ul class="menu-list">
                <li class="menu-item">Nombre de Usuario: <br> <?php echo htmlspecialchars($name); ?> <br> Email: <?php echo htmlspecialchars($email); ?></li>
                <li class="menu-item"><a href="error.php">Guía Rápida</a></li>
                <li class="menu-item"><a href="CerrarSesion.php" class="logout-link">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <div class="status-title">
            <h2>ESTADO DE LAS NOTEBOOKS</h2>
        </div>
        <div class="status-container">
            <?php foreach (['A', 'B', 'C'] as $category): ?>
                <div class="computer-list">
                    <?php foreach ($computers[$category] as $computer): ?>
                        <div class="computer-item" onclick="openModal('modal<?php echo $computer['id']; ?>')">
                            <span><?php echo $computer['id']; ?></span>
                            <div class="status <?php echo $computer['status']; ?>"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php foreach ($computers as $category => $computersList): ?>
        <?php foreach ($computersList as $computer): ?>
            <div id="modal<?php echo $computer['id']; ?>" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('modal<?php echo $computer['id']; ?>')">&times;</span>
                    <p>Mensaje para <?php echo $computer['id']; ?>:</p>
                    <p><?php echo $computer['message']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        window.onclick = function(event) {
            var modals = document.getElementsByClassName('modal');
            for (var i = 0; i < modals.length; i++) {
                if (event.target == modals[i]) {
                    modals[i].style.display = 'none';
                }
            }
        }
    </script>
</body>
</html>
