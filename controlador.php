<?php


Class Controlador{
    public static $con;

    public function __construct(){

        require_once('./modelo.php');

        setlocale(LC_ALL,"es_ES");

        self::$con = new ConectarBD();
        self::$con->conect();
    }

    public function EventosIndex($publicado=1){
        /*
        $lista= self::$con->buscarListaEventos();
        for($i = 0;$i <$lista->num_rows; $i++){
            $imagen=self::$con->buscarImagenesEvento(1);
        }
        echo($lista);*/
        return self::$con->devolverListaEventos($publicado);
    }

    public function devolverComentarios(){
        return self::$con->devolverComentarios();
    }

    public function EventosEnteros(){

        $evento = $_GET['ev'];

        return self::$con->devolverEvento($evento);
    }

    public function devolverEvento($id){


        return self::$con->devolverEvento($evento);
    }

    public function encontrarEventos($tipo_eventos,$palabras){

        return self::$con->encontrarEventos($tipo_eventos,$palabras);
    }

    public function sacarComentarioID($id){
        return self::$con->sacarComentarioID($id);
    }
    public function devolverPalabras(){
        return self::$con->devolverPalabras();
    }

    public function close(){
        self::$con->close();
    }





    public function checkLogin($nick,$pass){
        $user=self::$con->devolverUsuario($nick);
        if($user!=null && $pass!="" && password_verify($pass,$user->contrasenia))
            return true;
        return false;
    }

    public function devolverListaUsuarios(){
        return self::$con->devolverListaUsuarios();
    }

    public function devolverUsuario($nick){
        global $usuario;
        $usuario=self::$con->devolverUsuario($nick);
        return $usuario;
    }

    public function aniadirUsuario($nombre, $contrasenia,$email,$registrado=1,$moderador=0, $gestor_sitio=0, $super=0){
        $usuario=new Usuario();
        $usuario->nombre=$nombre;
        $usuario->contrasenia=$contrasenia;
        $usuario->email=$email;
        $usuario->registrado=$registrado;
        $usuario->moderador=$moderador;
        $usuario->gestor_sitio=$gestor_sitio;
        $usuario->super=$super;
        self::$con->aniadirUsuario($usuario);

        return $usuario;
    }

    public function editarUsuario($usuarioActual, $nombre,$email,$registrado=1,$moderador=0, $gestor_sitio=0, $super=0){        
        $usuario=new Usuario();
        $usuario->nombre=$nombre;
        $usuario->email=$email;
        $usuario->registrado=$registrado;
        $usuario->moderador=$moderador;
        $usuario->gestor_sitio=$gestor_sitio;
        $usuario->super=$super;
        self::$con->editarUsuario($usuarioActual,$usuario);

        return $usuario;
    }

    public static function editarPermisos($nombre, $moderador,$gestor,$super){
        self::$con->editarPermisos($nombre, $moderador,$gestor,$super);
    }
    public function editarContraseña($nombre,$contrasenia){        
        self::$con->editarContraseña($nombre,$contrasenia);

    }


    public function editarComentario($id, $nombre,$texto){
        self::$con->editarComentario($id, $nombre,$texto);

    }
public function editarEvento($id,$titulo,$nombre,$fecha,$autor,$texto,$linkEvento,$twitter){
        self::$con->editarEvento($id,$titulo,$nombre,$fecha,$autor,$texto,$linkEvento,$twitter);

    }

    public function cambiarEstadoEvento($ev,$estado){
        self::$con->cambiarEstadoEvento($ev,$estado);

    }



    public function aniadirEvento($titulo,$nombre,$fecha,$autor,$texto,$linkEvento,$twitter){
        return self::$con->aniadirEvento($titulo,$nombre,$fecha,$autor,$texto,$linkEvento,$twitter);
    }
    public function subirImagen($id,$file_name,$cabecera){
        return self::$con->subirImagen($id,$file_name,$cabecera);        
    }


    public function aniadirComentario($evento,$nombre,$email,$com){    
        $comentario = new Comentario();
                    $comentario->email = $email;
                    $comentario->nombre =$nombre;
                    $comentario->texto = $com;
                    $comentario->evento = $evento;
        self::$con->aniadirComentario($comentario);
        
    }
    public function aniadirEtiqueta($id,$nombre){    

        self::$con->aniadirEtiqueta($id,$nombre);
    }

    //ELIMINAR
    public function eliminarEvento($id){        
        self::$con->eliminarEvento($id);

    }

    public function eliminarComentario($id){      
        self::$con->eliminarComentario($id);
    }

    public function eliminarUsuario($nick){      
        self::$con->eliminarUsuario($nick);
    }
    public function eliminarEtiqueta($id,$eti){      
        self::$con->eliminarEtiqueta($id,$eti);
    }


    
}


//$con->buscarEvento(0);
//$eventosPrincipales = $con->getEventosPrincipales();
?>
