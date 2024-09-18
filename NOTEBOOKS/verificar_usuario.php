<?php
include("conexion.php");

if (isset($_POST['verify'])) {
    $email = trim($_POST['email']);

    // Consulta para verificar si el correo existe en la base de datos
    $checkEmailQuery = $conex->prepare("SELECT * FROM usuarios WHERE email = ?");
    $checkEmailQuery->bind_param("s", $email);
    $checkEmailQuery->execute();
    $checkEmailQuery->store_result();

    if ($checkEmailQuery->num_rows > 0) {
        // Si el usuario existe, redirige al formulario para establecer nueva contraseña
        header("Location: cambiar_password.php?email=" . urlencode($email));
        exit();
    } else {
        // Mostrar alerta y redirigir de nuevo al formulario si el correo no está registrado
        echo "<script>
                alert('El correo ingresado no está registrado. Por favor, ingrese un correo válido.');
                window.location.href = 'new_password.php';
              </script>";
    }

    $checkEmailQuery->close();
}
?>
