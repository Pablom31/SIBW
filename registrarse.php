<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'controlador.php';

  $falloRegistro=false;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nick = $_POST['nick2'];
    $pass = $_POST['contrasenia2'];
    $correo = $_POST['email2'];
    
    $controlador=new Controlador();
    if ($controlador->devolverUsuario($nick)==null){//checkLogin($nick, $pass)) {
      session_start(); 
      $usuario=$controlador->aniadirUsuario($nick,$pass,$correo);
      $_SESSION['user'] = $usuario;
      $_SESSION['controlador']=$controlador;

      header("Location: index.php");
    }else{
        $falloRegistro=true;
    }
    
    
    
  }
  
  echo $twig->render('iniciarSesion.html', ['falloRegistro'=>$falloRegistro]);
?>