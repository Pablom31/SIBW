<?php

require_once "/usr/local/lib/php/vendor/autoload.php";
require_once('./controlador.php');
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

  if (isset($_GET['imp'])) {
    $imp = $_GET['imp'];
  } else {
    $imp = 0;
  }
  
$controlador=new Controlador();
session_start();
if (isset($_SESSION['controlador']))
    $controlador=$_SESSION['controlador'];

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];//$controlador->getUser($_SESSION['nickUsuario']);
}else 
  $user=null;

$evento=$controlador->EventosEnteros();
$palabras=$controlador->devolverPalabras();
$controlador->close();
echo $twig->render('evento1.html',['evento'=>$evento,'palabras'=>$palabras,'imp'=>$imp,'user'=>$user]);
?>

