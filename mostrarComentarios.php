<?php

require_once "/usr/local/lib/php/vendor/autoload.php";
require_once('./controlador.php');

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


  
    $controlador=new Controlador();

    session_start();

    if (isset($_SESSION['user'])) 
        $user = $_SESSION['user'];//$controlador->getUser($_SESSION['nickUsuario']);

    $comentarios=[];
    $comentarios=$controlador->devolverComentarios();

$controlador->close();

echo $twig->render('mostrarComentarios.html',['comentarios'=>$comentarios,'user'=>$user]);
?>