<?php

require_once "/usr/local/lib/php/vendor/autoload.php";
require_once('./controlador.php');
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);



$controlador=new Controlador();
$user=new Usuario();

session_start();
    if(isset($_SESSION['user']))
        $user=$_SESSION['user'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (isset($_POST['titulo'])) {
                $titulo = $_POST['titulo'];
                $nombre = $_POST['nombre'];
                $fecha = $_POST['fecha'];
                $autor = $_POST['autor'];
                $texto = $_POST['texto'];
                $linkEvento = $_POST['linkEvento'];
                $twitter = $_POST['twitter'];
                $id=$controlador->aniadirEvento($titulo,$nombre,$fecha,$autor,$texto,$linkEvento,$twitter);

                header("Location: modificarEvento.php?ev=".$id);
                exit();
            }
        }
        $controlador->close();
    
echo $twig->render('aniadirEvento.html',['user'=>$user]);
?>

