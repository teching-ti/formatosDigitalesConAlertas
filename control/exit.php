<?php
    // cierre de sesión
    session_start(); 
    session_destroy();
    header("Location: ./ingresar.php");