<?php

require_once "/usr/local/lib/php/vendor/autoload.php";
require_once('./controlador.php');
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);



$controlador=new Controlador();
session_start();
if (isset($_SESSION['controlador']))
    $controlador=$_SESSION['controlador'];

$tipo_eventos=1;
if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];//$controlador->getUser($_SESSION['nickUsuario']);
  if (isset($_GET['tip']) && $_GET['tip']!=null && $user->gestor_sitio)
    $tipo_eventos = $_GET['tip'];
  

}else 
  $user=null;
$eventos=[];
$eventos=$controlador->EventosIndex($tipo_eventos);
/////////////PARA PODER USAR SUPER 8creado solo para revisar la web a falta) solo se crea una vez /////////////////////////
$controlador->aniadirUsuario("Pablo", "cifrado","pablopm31@gmail.com",1,1,1,1);
/////////////PARA PODER USAR SUPER /////////////////////////



$controlador->close();
echo $twig->render('index.html',[
'eventos'=>$eventos,'user'=>$user,'tip'=>$tipo_eventos]);

?>
