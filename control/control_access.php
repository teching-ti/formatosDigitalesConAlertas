<?php
  session_start();
  if(isset($_SESSION['usuario']) && ($_SESSION['perfil'] === "admin" || $_SESSION['perfil'] === "techformuser")) {
    echo "";
  }else{
    header("location: ../control/exit.php");
  }