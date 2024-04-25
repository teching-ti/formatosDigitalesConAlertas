<?php
require("./db.php");
require("./control_access.php");//1

// se verifica si existe el inicio de sesión por parte del usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['passw'];
    // perfil modificable por primer caso*
    $perfil = $_POST['perfil'];

    // se encripta contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // variable de sentencia sql
    $stmt = null;


    if($perfil === 'techformuser'){    //2
        // se inserta el nuevo registro en la base de datos
        $sql = "INSERT INTO usuarios (id, nombre_usuario, contrasena, perfil) VALUES (:id, :username, :passteching, :prof)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':passteching', $hashed_password);
        $stmt->bindParam(':prof', $perfil);
    }//3

    try{
        // tratar de ejecutar la sentencia 
        if($stmt !== null){
            $stmt->execute();
        }
        header("Location: exit.php");
        exit();
    } catch (Exception $e){
        // error al registrar al usuario, no explicar el motivo
        // cerrar sesion
        header("Location: exit.php");
    }
}
?>
<?php
if($_SESSION["perfil"]==="admin"){ //4
?>
    <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Registro</title>
        </head>
        <body>
            <h2>Registro</h2>
            <?php if (isset($error_message)) { ?>
                <p><?php echo $error_message; ?></p>
            <?php } ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="id">ID:</label><br>
                <input type="text" id="id" name="id" required><br>
                <label for="username">Usuario:</label><br>
                <input type="text" id="username" name="username" required><br>
                <label for="passw">Contraseña:</label><br>
                <input type="passw" id="passw" name="passw" required><br>
                <label for="perfil">Perfil</label><br>
                <input type="text" id="perfil" name="perfil" required><br><br>
                <input type="submit" value="Registrar">
            </form>
        </body>
    </html>
<?php

}else{   //5
header("location: ../formatos/menu_formatos.php");   //5
}   //5
?>

