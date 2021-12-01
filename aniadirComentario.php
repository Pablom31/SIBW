<?php

require_once "/usr/local/lib/php/vendor/autoload.php";
require_once('./controlador.php');
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


  
$controlador=new Controlador();
$user=new Usuario();
session_start();
    if(isset($_SESSION['user'])){
        $user=$_SESSION['user'];
        if (isset($_SESSION['controlador'])){
            $controlador=$_SESSION['controlador'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                if (isset($_POST['coment']) && isset($_GET['ev'])) {
                    $comen = $_POST['coment'];
                    $ev= $_GET['ev'];
                    $controlador->aniadirComentario($ev,$user->nombre,$user->email,$comen);

                    header("Location: evento.php?ev=" . $ev);
                    exit();
                }
            }
        $controlador->close();
        header("Location: index.php");
    }
    exit();
}
?>

