<?php

session_start();

$conn = new mysqli("localhost", "root", "", "pp_note");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT contraseña, nombre FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['contraseña'];
        $name = $row['nombre'];

        if (password_verify($password, $hashed_password)) {
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            echo "<script>alert('Inicio de sesión exitoso :)'); window.location.href='Principal.php';</script>";
        } else {
            echo "<script>alert('El Email o Contraseña son incorrectos, intente nuevamente'); window.location.href='login.php';</script>";
        }
    } else {
        $sql_prof = "SELECT contraseña, nombre FROM usuarios WHERE email = ?";
        $stmt_prof = $conn->prepare($sql_prof);
        $stmt_prof->bind_param("s", $email);
        $stmt_prof->execute();
        $result_prof = $stmt_prof->get_result();

        if ($result_prof->num_rows > 0) {
            $row_prof = $result_prof->fetch_assoc();
            $hashed_password_prof = $row_prof['contraseña'];
            $name_prof = $row_prof['nombre'];

            if (password_verify($password, $hashed_password_prof)) {
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $name_prof;
                echo "<script>alert('Inicio de sesión exitoso como profesor'); window.location.href='Principal.php';</script>";
            } else {
                echo "<script>alert('El Email o Contraseña son incorrectos, intente nuevamente'); window.location.href='login.php';</script>";
            }
        } else {
            echo "<script>alert('El usuario ingresado no existe'); window.location.href='login.php';</script>";
        }
    }
    $stmt->close();
    $stmt_prof->close();
}

$conn->close();
?>
