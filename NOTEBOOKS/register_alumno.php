<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumnos - OK NOTEBOOKS</title>
    <link rel="stylesheet" href="estilos/register_style.css">
    <link rel="icon" href="imagenes/logo.ico">
    <script>
function validateDivision() {
    var divisionInput = document.getElementById('division');
    var especialidadInput = document.getElementById('especialidad-wrapper');
    var divisionValue = divisionInput.value;

    if (!/^[\d°]*$/.test(divisionValue)) {
        divisionInput.setCustomValidity("Por favor, ingrese solo números y el símbolo '°'.");
        divisionInput.reportValidity(); 
        return;
    }

    divisionInput.setCustomValidity(""); 

    var cleanDivisionValue = divisionValue.replace('°', ''); 
    var firstDigit = parseInt(cleanDivisionValue.charAt(0));

    if (isNaN(firstDigit) || firstDigit < 1 || firstDigit > 6) {
        divisionInput.setCustomValidity("El Año debe ser entre 1 y 6.");
    } else {
        divisionInput.setCustomValidity(""); 
        if (firstDigit >= 3) {
            especialidadInput.style.display = 'block'; 
            document.getElementById('especial').required = true; 
        } else {
            especialidadInput.style.display = 'none'; 
            document.getElementById('especial').required = false; 
        }
    }
}
</script>

</head>
<body>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

        <div class="form-header">
            <img src="imagenes/OK.png" alt="Logo" class="header-image">
            <h2>Registro de alumnos</h2>
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

        <div class="input-wrapper"> <!-- division -->
            <input type="text" name="division" id="division" placeholder="Division" required="" oninput="validateDivision()">
		</div>

        <div class="input-wrapper" id="especialidad-wrapper" style="display:none;"> <!-- especialidad -->
            <select name="especial" id="especial">
                <option value="" disabled selected>Selecciona tu Especialidad</option>
                <option value="Computacion">Computacion</option>
                <option value="Construcciones">Construcciones</option>
                <option value="Electricidad">Electricidad</option>
                <option value="Electronica">Electronica</option>
                <option value="Mecanica">Mecanica</option>
                <option value="Quimica">Quimica</option>
            </select>
		</div>

        <input class="btn" type="submit" name="register" value="Enviar">

        <p>Ya tienes un usuario? -> <a href="login.php" class="create-account">Ingrese aqui</a></p>
        <p>Si es un profesor ingrese al siguiente enlace -> <a href="register_profe.php" class="create-account">Ingrese aqui</a></p>
        <p><a href="index.php" class="create-account">  <--Volver al inicio</a></p>
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include("RegistrarAlumno.php");
        }
    ?>
    
</body>
</html>
