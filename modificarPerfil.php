<?php

require_once "/usr/local/lib/php/vendor/autoload.php";
require_once('./controlador.php');

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


  
$controlador=new Controlador();
session_start();


if (isset($_SESSION['controlador']))
    $controlador=$_SESSION['controlador'];

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];//$controlador->getUser($_SESSION['nickUsuario']);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['nombre'])){
            $nick=$_POST['nombre'];
            $controlador->editarUsuario($user,$nick,$user->email,
                $user->registrado,$user->moderador, $user->gestor_sitio, $user->super);
            //$user->registrado,$user->moderador, $user->gestor_sitio, $user->super);
            $user->nombre=$nick;
            $_SESSION['user']=$user;
        }
        if (isset($_POST['password1'])){
            $pass = $_POST['password1'];
            
            $controlador->editarContraseña($user->nombre,$pass);
        }
        if (isset($_POST['email1'])){
            $email = $_POST['email1'];
            $controlador->editarUsuario($user,$user->nombre,$user->contrasenia,$email,
                $user->registrado,$user->moderador, $user->gestor_sitio, $user->super);
            $user->email=$email;
            $_SESSION['user']=$user;

        }
    }
}else 
  $user=null;



    
/*$evento=$controlador->EventosEnteros();
$palabras=$controlador->devolverPalabras();
*/


echo $twig->render('modificarPerfil.html',['user'=>$user]);
?>
