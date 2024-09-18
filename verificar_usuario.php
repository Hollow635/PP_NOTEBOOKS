<?php
include("conexion.php");

if (isset($_POST['verify'])) {
    $email = trim($_POST['email']);

    $checkEmailQuery = $conex->prepare("SELECT * FROM usuario WHERE email = ?");
    $checkEmailQuery->bind_param("s", $email);
    $checkEmailQuery->execute();
    $checkEmailQuery->store_result();

    if ($checkEmailQuery->num_rows > 0) {
        header("Location: cambiar_password.php?email=" . urlencode($email));
        exit();
    } else {
        echo "<script>
                alert('El correo ingresado no está registrado. Por favor, ingrese un correo válido.');
                window.location.href = 'new_password.php';
              </script>";
    }

    $checkEmailQuery->close();
}
?>
