<?php 
   $usuario = strtolower($_POST['usuario']);
   $email = strtolower($_POST['email']);
   session_start();
   $_SESSION["usuario"] = $usuario;
   $_SESSION["email"] = $email;
   header("Location: index.php");
?>