<?php

require("./db.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // se capturan los datos obtenidos desde el formulario
    $username = $_POST['username'];
    $password = $_POST['passw'];

    // Consultar la base de datos para obtener la contraseña encriptada del usuario
    $sql = "SELECT contrasena, perfil FROM usuarios WHERE nombre_usuario = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row){
        $hashed_password = $row['contrasena'];
        // realizando verificación de contraseña
        if (password_verify($password, $hashed_password)) {
            // si la contraseña es válida se puede
            // variables de sesion
            $_SESSION['usuario'] = $username;
            $_SESSION['perfil'] = $row['perfil'];
            // redirigir para comprobar
            header("Location: ../formatos/menu_formatos.php");
            exit(); // cerrando el script
        } else {
            // Si la contraseña es incorrecta, mostrar un mensaje de error
            echo "<script>alert('Credenciales incorrectas')</script>";
        }

    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar</title>
    <?php 
        require("../formatos/header_comun/scripts_links.php");
    ?>
    <link rel="stylesheet" href="../estilos/stylesIngresar.css" />
</head>
<body>
    <main>
        <form action="ingresar.php" method="post" class='form-login'>
            <figure>
                <img src="../recursos/logo_teching.png" alt="imagen teching">
            </figure>
            <h2>Ingresar</h2>
            <div class='container-input'>
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="container-input">
                <label for="passw">Contraseña</label>
                <input type="password" id="passw" name="passw" required>
            </div>
            <input type="submit" value="Iniciar Sesión" class="btn-ingresar">
        </form>
    </main>
</body>
</html>