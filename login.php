<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="estilos/login_style.css">
    <link rel="icon" href="imagenes/logo.ico">
</head>
<body>

    <form action="IniciarSesion.php" method="post" >

        <div class="form-header">
            <img src="imagenes/OK.png" alt="Logo" class="header-image">
            <h2>Iniciar Sesion</h2>
        </div>

        <div class="input-wrapper"> 
            <input type="email" name="email" placeholder="Correo Electronico" required="">
        </div>

        <div class="input-wrapper"> 
            <input type="password" name="password" placeholder="Contraseña" required="">
		</div>

        <p><a href="new_password.php" class="create-account">Olvidaste la contraseña?</a></p>

        <input class="btn" type="submit" name="register" value="Iniciar Sesion">

        <p><a href="register_alumno.php" class="create-account">Registrarse como alumno</a></p>
        <p><a href="register_profe.php" class="create-account">Registrarse como profesor</a></p>
    </form>
    
</body>
</html>
