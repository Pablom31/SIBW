<?php

require_once "/usr/local/lib/php/vendor/autoload.php";
require_once('./controlador.php');
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


  
$controlador=new Controlador();

session_start();
    if($_SESSION['user']->gestor_sitio){
        if (isset($_SESSION['controlador'])){
            $controlador=$_SESSION['controlador'];

            if (isset($_GET['ev'])) {
                $ev = $_GET['ev'];
                
                $controlador->eliminarEvento($ev);

            }

        $controlador->close();
        }
    }
    header("Location: index.php");
    exit();

?>

