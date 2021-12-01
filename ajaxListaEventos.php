<?php


    header('Content-Type: application/json');
    require_once "/usr/local/lib/php/vendor/autoload.php";
    require_once('./controlador.php');

    
    $palabras = $_GET['palabra'];
    $datos = [];
    $controlador = new Controlador();
    session_start();
    if (isset($_SESSION['controlador']))
        $controlador=$_SESSION['controlador'];

    $tipo_eventos=1;
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        if($user->gestor_sitio){
            $tipo_eventos=2;
        }
    }

    $datos=$controlador->encontrarEventos($tipo_eventos,$palabras);

  
  echo(json_encode($datos));
?>