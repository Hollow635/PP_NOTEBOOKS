<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Profesores - OK NOTEBOOKS</title>
    <link rel="stylesheet" href="estilos/register_style.css">
    <link rel="icon" href="imagenes/logo.ico">
</head>
<body>

    <form method="post" >

        <div class="form-header">
            <img src="imagenes/OK.png" alt="Logo" class="header-image">
            <h2>Registro de profes</h2>
        </div>

        <div class="input-wrapper">  <!-- nombre -->
            <input type="text" name="name" placeholder="Nombre Completo" required="">
        </div>

        <div class="input-wrapper"> <!-- correo electronico / email --> 
            <input type="email" name="email" placeholder="Correo Electronico" required="">
        </div>

        <div class="input-wrapper"> <!-- contraseña -->
            <input type="password" name="password" placeholder="Contraseña" required="">
		</div>

        <input class="btn" type="submit" name="register" value="Enviar">

        <p>Ya tienes un usuario? -> <a href="login.php" class="create-account">Ingrese aqui</a></p>
        <p>Si es un alumno ingrese en el siguiente enlace -> <a href="register_alumno.php" class="create-account">Ingrese aqui</a></p>
        <p><a href="index.php" class="create-account">  <--Volver al inicio</a></p>
    </form>

<?php
    include("RegistrarProfe.php");
?>
    
</body>
</html>
