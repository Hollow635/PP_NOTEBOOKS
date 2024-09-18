<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="estilos/login_style.css">
    <link rel="icon" href="imagenes/logo.ico">
</head>
<body>

    <?php
    $email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
    ?>

    <form action="actualizar_password.php" method="post">
        <input type="hidden" name="email" value="<?php echo $email; ?>">

        <div class="form-header">
            <h2>Establecer Nueva Contraseña</h2>
        </div>

        <div class="input-wrapper">
            <input type="password" name="new_password" placeholder="Nueva Contraseña" required="">
        </div>

        <div class="input-wrapper">
            <input type="password" name="confirm_password" placeholder="Confirmar Contraseña" required="">
        </div>

        <input class="btn" type="submit" name="change_password" value="Cambiar Contraseña">
    </form>
    
</body>
</html>
