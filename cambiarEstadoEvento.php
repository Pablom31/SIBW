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

            if (isset($_GET['tip']))
                $tipo_eventos = $_GET['tip'];
            else 
                $tipo_eventos=1;

            if (isset($_GET['ev']) && isset($_GET['estado'])) {
                $ev = $_GET['ev'];
                $estado = $_GET['estado'];
                $controlador->cambiarEstadoEvento($ev,$estado);
            }

        }
        $controlador->close();
        header("Location: index.php?tip=".$tipo_eventos);
        exit();
    }
    $controlador->close();
    header("Location: index.php");
    exit();
?>
