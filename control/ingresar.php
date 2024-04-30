<?php

require("./db.php");

session_start();

if(isset($_SESSION['usuario']) && isset($_SESSION['perfil'])) {
    // Si ya hay una sesión activa, redirigir al usuario a otra página
    header("Location: ../index.php");
    exit(); // Terminar el script
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // se capturan los datos obtenidos desde el formulario
    $username = $_POST['username'];
    $password = $_POST['passw'];

    // Consultar la base de datos para obtener la contraseña encriptada del usuario
    $sql = "SELECT id_usuario, contrasena, perfil FROM usuarios WHERE nombre_usuario = :username";
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
            $id = $row['id_usuario'];
            $_SESSION['usuario'] = $username;
            $_SESSION['perfil'] = $row['perfil'];

            // registrar el inicio de sesion
            $sql_insert = "INSERT INTO registros_inicio_sesion (id_usuario) values (:id_usuario)";
            $smtm_insert = $pdo->prepare($sql_insert);
            $smtm_insert->bindParam(':id_usuario', $id);
            $smtm_insert->execute();

            // redirigir para comprobar
            header("Location: ../formatos/menu_formatos.php");
            exit(); // cerrando el script
        } else {
            // Si la contraseña es incorrecta, mostrar un mensaje de error
            echo "<script>alert('Datos incorrectos')</script>";
        }
    }else{
        echo "<script>alert('Datos incorrectos')</script>";
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
            <h2>Formatos Digitales</h2>
            <h4>Balance y Corección de Cadena</h4>
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