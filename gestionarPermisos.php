<?php

require_once "/usr/local/lib/php/vendor/autoload.php";
require_once('./controlador.php');

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


  

    $controlador=new Controlador();

    session_start();

    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_GET['us'])){
                    $nick = $_GET['us'];
                    if(isset($_POST['moderador'])){
                        $moderador = $_POST['moderador'];
                    }else
                        $moderador=0;

                    if(isset($_POST['gestor']))
                        $gestor = $_POST['gestor'];
                    else
                        $gestor=0;

                    if(isset($_POST['super']))
                        $super = $_POST['super'];
                    else
                        $super=0;
                    
                    if($nick!=$user->nombre)
                        $controlador->editarPermisos($nick, $moderador,$gestor,$super);
                }

        }
    }else 
        $user=null;



    
$usuarios=$controlador->devolverListaUsuarios();
$controlador->close();

echo $twig->render('gestionarPermisos.html',['usuarios'=>$usuarios,'user'=>$user]);
?>
