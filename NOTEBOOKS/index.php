<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="estilos/index_style.css"> 
    <link rel="icon" href="imagenes/logo.ico">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">
                <img src="imagenes/OK.png" alt="Logo Otto Krause">
                <div class="header-text">
                </div>
            </div>
            <div class="auth-buttons">
                <button onclick="window.location.href='login.php'">Iniciar Sesion</button>
                <button onclick="window.location.href='register_alumno.php'">Registrarse</button>
            </div>
        </div>
    </header>
    <main>
        <h1>Bienvenido al sistema de prestamo de Notebooks de la escuela Otto Krause</h1>
        <p>En este servicio de la escuela, los alumnos y profesores podran realizar el prestamo de Computadoras
            de forma rapida y anticipada para poder usarlas</p>
        <p>Para ello tendran que tener una cuenta o usuario accesible al sistema</p>
        <p>No tiene un usuario creado? <a href="register_alumno.php">Registrese Aqui</a></p>
        <p>Si usted tiene dudas sobre como funciona el servicios, visite nuestra pagina de preguntas frecuentes -> <a href="guia.php">Guia de usuario</a></p>
        <h2>Sistema creado por el equipo Compilando Compus(6°2° COM)</h2>
    </main>
</body>
</html>