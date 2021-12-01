<?php

require_once "/usr/local/lib/php/vendor/autoload.php";
require_once('./controlador.php');
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


  
$controlador=new Controlador();

session_start();

    if($_SESSION['user']->moderador){
        if (isset($_SESSION['controlador'])){
            $controlador=$_SESSION['controlador'];

            if (isset($_GET['ev']) && isset($_GET['eti'])) {
                $ev = $_GET['ev'];
                $eti = $_GET['eti'];
                $controlador->eliminarEtiqueta($ev,$eti);

            }

        }
    $controlador->close();
    header("Location: evento.php?ev=$ev");
    exit();
}
    $controlador->close();
    header("Location: index.php");
    exit();
?>
