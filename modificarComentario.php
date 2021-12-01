<?php

require_once "/usr/local/lib/php/vendor/autoload.php";
require_once('./controlador.php');

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


  
$controlador=new Controlador();
$comentario=new Comentario();
$comentario1=new Comentario();

if (isset($_GET['comen'])){
    $id=$_GET['comen'];
}else
    $id=0;
session_start();


if (isset($_SESSION['controlador']))
    $controlador=$_SESSION['controlador'];

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];//$controlador->getUser($_SESSION['nickUsuario']);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['titulo']) && isset($_POST['texto'])){

            $id=$_POST['idd'];
            $comentario1->nombre= $_POST['titulo'];
            $comentario1->texto=$_POST['texto'];
            
 


            $controlador->editarComentario($id,$comentario1->nombre,$comentario1->texto);
            $controlador->close();
            header("Location: index.php");
            exit();
        }
  }

}else 
  $user=null;



    
$comentario=$controlador->sacarComentarioID($id);
$controlador->close();

echo $twig->render('modificarComentario.html',['user'=>$user,'comentario'=>$comentario]);
?>
