<?php
include("conexion.php");

if (isset($_POST['register'])) {
    $division = trim($_POST['division']);
    $division_valida = false;
    $especial_existe = isset($_POST['especial']) && strlen(trim($_POST['especial'])) >= 1;

    // Validación de la división
    if (!preg_match('/^[\d°]+$/', $division)) {
        ?>
        <h3 class="error">La división debe contener solo números y el símbolo '°'.</h3>
        <?php
        exit();
    }

    $cleanDivision = str_replace('°', '', $division);
    $primer_digito = (int) substr($cleanDivision, 0, 1);

    // Validación de la especialidad o ciclo básico
    if ($primer_digito >= 1 && $primer_digito <= 3) {
        $especialidad = "Ciclo Básico";
    } elseif ($primer_digito >= 4 && $primer_digito <= 6) {
        $division_valida = true;
        $especialidad = $especial_existe ? trim($_POST['especial']) : 'Ciclo Básico';  
    } else {
        ?>
        <h3 class="error">El Año debe estar en el rango de 1 a 6.</h3>
        <?php
        exit();
    }

    // Validación de campos completos
    if (
        strlen($_POST['name']) >= 1 &&
        strlen($_POST['email']) >= 1 &&
        strlen($_POST['password']) >= 1 &&
        strlen($division) >= 1 &&
        (!$division_valida || $especial_existe)
    ) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $fecha = date("Y-m-d");
        $tipo_usuario = "Alumno";  // Asignar el tipo de usuario siempre como "Alumno"

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
            // Preparar la consulta para insertar el nuevo alumno
            $consulta = $conex->prepare("INSERT INTO usuario(nombre, email, contraseña, division, especialidad, tipo_usuario, fecha) VALUES (?, ?, ?, ?, ?, ?, ?)");
            if ($consulta) { 
                $consulta->bind_param("sssssss", $name, $email, $hashed_password, $division, $especialidad, $tipo_usuario, $fecha);
                if ($consulta->execute()) {
                    ?>
                    <h3 class="success">Tu registro como alumno se ha completado</h3>
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
        <h3 class="error">Llena todos los campos correctamente. Asegúrate de que la división esté en el rango de 1 a 6 y, si corresponde, la especialidad esté seleccionada.</h3>
        <?php
    }
}
?>
