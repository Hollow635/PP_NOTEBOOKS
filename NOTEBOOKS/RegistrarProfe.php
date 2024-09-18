<?php
include("conexion.php");

if (isset($_POST['register'])) {
    // Verificamos si se llenaron todos los campos
    if (
        strlen($_POST['name']) >= 1 &&
        strlen($_POST['email']) >= 1 &&
        strlen($_POST['password']) >= 1
    ) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $fecha = date("Y-m-d");
        $tipo_usuario = "Profesor";  // Asignar siempre como "Profesor"

        // Verificar si el email ya está registrado
        $checkEmailQuery = $conex->prepare("SELECT * FROM usuario WHERE email = ?");
        if (!$checkEmailQuery) {
            die("Error en la preparación de la consulta: " . $conex->error);
        }

        $checkEmailQuery->bind_param("s", $email);
        if (!$checkEmailQuery->execute()) {
            die("Error al ejecutar la consulta de verificación de correo: " . $checkEmailQuery->error);
        }

        $checkEmailQuery->store_result();

        if ($checkEmailQuery->num_rows > 0) {
            ?>
            <h3 class="error">El correo ya está registrado. Por favor, use un correo diferente.</h3>
            <?php
        } else {
            // Modificar el INSERT para incluir el tipo de usuario como "Profesor"
            $consulta = $conex->prepare("INSERT INTO usuario(nombre, email, contraseña, tipo_usuario, fecha) VALUES (?, ?, ?, ?, ?)");
            if ($consulta) { 
                $consulta->bind_param("sssss", $name, $email, $hashed_password, $tipo_usuario, $fecha);
                if ($consulta->execute()) {
                    ?>
                    <h3 class="success">Tu registro como profesor se ha completado</h3>
                    <?php
                } else {
                    ?>
                    <h3 class="error">Ocurrió un error al registrarse: <?php echo $consulta->error; ?></h3>
                    <?php
                }
                $consulta->close(); 
            } else {
                ?>
                <h3 class="error">Error en la preparación de la consulta de inserción: <?php echo $conex->error; ?></h3>
                <?php
            }
        }

        $checkEmailQuery->close();
    } else {
        ?>
        <h3 class="error">Llena todos los campos</h3>
        <?php
    }
}
?>
