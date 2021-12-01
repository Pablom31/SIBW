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
            if(isset($_FILES['imagen'])){
                $errors= array();
                $id = $_POST['id'];
                $file_name = $_FILES['imagen']['name'];
                $file_size = $_FILES['imagen']['size'];
                $file_tmp = $_FILES['imagen']['tmp_name'];
                $file_type = $_FILES['imagen']['type'];

                if(isset($_POST['cabecera']))
                    $cabecera=$_POST['cabecera'];
                else
                $cabecera="";


                $file_ext = strtolower(end(explode('.',$_FILES['imagen']['name'])));
                
                $extensions= array("jpeg","jpg","png");
                
                if (in_array($file_ext,$extensions) === false){
                $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
                }
                
                //SUBIR DE TAMAÑO
                if ($file_size > 2097152){
                $errors[] = 'Tamaño del fichero demasiado grande';
                }
                
                if (empty($errors)==true) {
                move_uploaded_file($file_tmp, "imagenes/" . basename($file_name));
                $controlador->subirImagen($id,$file_name,$cabecera);

                } 
                if (sizeof($errors) > 0) {
                    $varsParaTwig['errores'] = $errors;

                    
                }

            } 
 
            $controlador->close();
            header("Location: modificarImagenes.php?ev=".$id);
            exit();
        }
        
    
$evento=$controlador->EventosEnteros();
$controlador->close();
echo $twig->render('modificarEvento.html',['user'=>$user,'evento'=>$evento]);
?>
