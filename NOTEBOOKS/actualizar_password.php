<?php
include("conexion.php");

if (isset($_POST['change_password'])) {
    $email = trim($_POST['email']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($new_password === $confirm_password) {

        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $updateQuery = $conex->prepare("UPDATE usuarios SET contraseña = ? WHERE email = ?");
        $updateQuery->bind_param("ss", $hashed_password, $email);

        if ($updateQuery->execute()) {

            echo "<h3 class='success'>Contraseña actualizada correctamente. Redirigiendo a la página de inicio de sesión...</h3>";
            echo "<script>setTimeout(function() { window.location.href = 'login.php'; }, 3000);</script>";
        } else {

            echo "<h3 class='error'>Ocurrió un error al actualizar la contraseña. Por favor, inténtelo de nuevo.</h3>";
        }

        $updateQuery->close();
    } else {

        echo "<h3 class='error'>Las contraseñas no coinciden. Por favor, intente de nuevo.</h3>";
        echo "<script>setTimeout(function() { window.location.href = 'cambiar_password.php'; }, 3000);</script>";
    }
}
?>
