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
                if (isset($_POST['id'])) {
                    $ev = $_POST['id'];
                    $eti = $_POST['eti'];
                    $controlador->aniadirEtiqueta($ev,$eti);

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
