<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'controlador.php';

  $fallo=false;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nick = $_POST['nick'];
    $pass = $_POST['contrasenia'];
    
    $controlador=new Controlador();
    if ($controlador->checkLogin($nick, $pass)){//checkLogin($nick, $pass)) {
      session_start();
      
      $_SESSION['controlador']=$controlador;
      $_SESSION['user'] = $controlador->devolverUsuario($nick);  // guardo en la sesión el nick del usuario que se ha logueado
      header("Location: index.php");
    }else{
        $fallo=true;
    }
    
    
    
  }
  
  echo $twig->render('iniciarSesion.html', ['fallo'=>$fallo]);
?>