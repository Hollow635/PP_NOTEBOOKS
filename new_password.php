<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="estilos/login_style.css">
    <link rel="icon" href="imagenes/logo.ico">
</head>
<body>

    <form action="verificar_usuario.php" method="post">

        <div class="form-header">
            <img src="imagenes/OK.png" alt="Logo" class="header-image">
            <h2>Recuperar su contraseña</h2>
        </div>

        <p>Ingrese su Email para continuar con el cambio de contraseña</p>
        <div class="input-wrapper"> <!-- correo electronico / email --> 
            <input type="email" name="email" placeholder="Correo Electrónico" required="">
        </div>

        <input class="btn" type="submit" name="verify" value="Continuar">

        <p><a href="index.php" class="create-account">Volver al inicio</a></p>
    
    </form>
    
</body>
</html>
