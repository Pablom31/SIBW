<?php

require_once "/usr/local/lib/php/vendor/autoload.php";
require_once('./controlador.php');

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


  
$controlador=new Controlador();

session_start();
    if(isset($_SESSION['user']))
        $user=$_SESSION['user'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (isset($_POST['titulo'])) {
                $id = $_POST['id'];
                $titulo = $_POST['titulo'];
                $nombre = $_POST['nombre'];
                $fecha = $_POST['fecha'];
                $autor = $_POST['autor'];
                $texto = $_POST['texto'];
                $linkEvento = $_POST['linkEvento'];
                $twitter = $_POST['twitter'];
                $controlador->editarEvento($id,$titulo,$nombre,$fecha,$autor,$texto,$linkEvento,$twitter);

                $controlador->close();
                header("Location: evento.php?ev=".$id);
                exit();
            }
        }
    
$evento=$controlador->EventosEnteros();
$controlador->close();
echo $twig->render('modificarEvento.html',['user'=>$user,'evento'=>$evento]);
?>
