<?php


class Comentario{
    public $id;
    public $evento=0;
    public $nombre;
    public $email="" ;
    public $fecha;
    public $texto;
    public $editado = false;
    public function __constructor($id_,$nombre_,$email_,$fecha_,$texto_){
        $id=$id_;
        $nombre=$nombre_;
        $email=$email_;
        $fecha=$fecha_;
        $texto=$texto_;
    }
}

Class Evento{
    public $id;
    public $nombre;
    public $titulo;
    public $fecha;
    public $fecha_publicacion;
    public $texto="";
    public $autor;
    public $linkEvento="";
    public $twitter="";
    public $imagen=[];
    public $comentario =[];
    public $etiquetas=[];
    public $publicado;
}

Class Usuario{
    public $id;
    public $nombre="";
    public $contrasenia="";
    public $email="";
    public $registrado=true;
    public $moderador=false;
    public $gestor_sitio=false;
    public $super=false;

}

Class Imagenes{
    public $imagen="";
    public $descripcion="";
    public function __constructor($img,$desc){
        $imagen=$img;
        $descripcion=$desc;
    }
}


class ConectarBD{
    public static $conexion;

    public static function conect(){
        self::$conexion=new mysqli("mysql", "pablopm31", "pablopm31", "SIBW");
        if (self::$conexion->connect_error) {
            echo ("Fallo al conectar: " . self::$conexion->connect_error);
        }
        self::$conexion->query("SET NAMES 'utf8'");

        return self::$conexion;
    }

    public static function close(){
        self::$conexion->close();
        return 0;
    }

    public static function devolverListaEventos($publicado=1){
        $eventonomb= self::buscarListaEventos($publicado);
                /*$au=new Usuario();
                $au->nombre="pablo";
                $au->contrasenia="cifrado"; 
                $au->email="pablo21@gmail.com";
                $au->moderador=1;
                $au->gestor_sitio=1;
                $au->super=1;
                 self::aniadirUsuario($au);
                 self::devolverListaUsuarios();
                 self::devolverUsuario("pablo2212121212121212323");*/
                 
        $listaEventos=[];

            while($filanomb = $eventonomb->fetch_array(MYSQLI_ASSOC)){

                $eventoimg=self::buscarImagenesEvento($filanomb['id']);

                $eventocompleto= new Evento();
                $eventocompleto->id = $filanomb['id'];
                $eventocompleto->nombre = $filanomb['nombre'];
                if($filaimg = $eventoimg->fetch_array(MYSQLI_ASSOC)){
                    $eventocompleto->imagen[]= $filaimg['img'];
                }
                $eventocompleto->publicado = $filanomb['publicado'];
                $listaEventos[]= $eventocompleto;
                
            }


            //GUARDAR IMAGENES
        return $listaEventos;
    }

    public static function encontrarEventos($tipo_eventos,$palabras){
        $lista=self::listaEventosBusqueda($tipo_eventos,$palabras);
        $listaEventos=[];

            while($filanomb = $lista->fetch_array(MYSQLI_ASSOC)){

                $eventoimg=self::buscarImagenesEvento($filanomb['id']);

                $eventocompleto= new Evento();
                $eventocompleto->id = $filanomb['id'];
                $eventocompleto->nombre = $filanomb['nombre'];
                if($filaimg = $eventoimg->fetch_array(MYSQLI_ASSOC)){
                    $eventocompleto->imagen[]= $filaimg['img'];
                }
                $eventocompleto->publicado = $filanomb['publicado'];
                $listaEventos[]= $eventocompleto;
                
            }
        return $listaEventos;
    }

    
    public static function devolverEvento($id){

        $eventoinfo= self::buscarEvento($id);
        $eventoimg=self::buscarImagenesEvento($id);
        $eventocomentarios=self::buscarComentarioEvento($id);

        $eventoEtiquetas=self::buscarEtiquetasEvento($id);
        $eventocompleto= new Evento();  
        
        if($evento = $eventoinfo->fetch_array()){
            $eventocompleto->id = $evento['id'];
            $eventocompleto->nombre = $evento['nombre'];
            $eventocompleto->titulo = $evento['titulo'];
            $eventocompleto->fecha = $evento['fecha'];
            $eventocompleto->fecha_publicacion = $evento['fecha_publicacion'];
            $eventocompleto->autor = $evento['autor'];
            $eventocompleto->texto = $evento['texto'];
            $eventocompleto->linkEvento = $evento.['linkEvento'];
            $eventocompleto->link = $evento['link'];
            $eventocompleto->twitter = $evento['twitter'];
            $eventocompleto->publicado = $evento['publicado'];

            while($fila= $eventoimg->fetch_array()){ 
                $img=new Imagenes();
                $img->descripcion =$fila['descripcion'];
                $img->imagen=$fila['img'];
                $eventocompleto->imagen[]=$img;

            }

            while($fila_comen= $eventocomentarios->fetch_array()){       
                //$eventocompleto->comentario[]=new Comentario($fila_comen['id_evento'],$fila_comen['nombre'],$fila_comen['email'],$fila_comen['fecha'],$fila_comen['texto']);
                    $coment=new Comentario();
                    $coment->evento = $fila_comen['id_evento'];
                    $coment->id = $fila_comen['id'];
                    $coment->nombre =$fila_comen['usuario'];
                    //$coment->email =$fila_comen['email'];
                    $coment->fecha = $fila_comen['fecha'];
                    $coment->texto = $fila_comen['comentario'];
                    $coment->editado = $fila_comen['modificado'];
                    $eventocompleto->comentario[]=$coment;
            }


            while($fila_etiqueta= $eventoEtiquetas->fetch_array()){ 
                $eventocompleto->etiquetas[]= $fila_etiqueta['nombre'];
            }
        }
        return $eventocompleto;
    }

    public static function devolverComentarios(){
        $lista=self::listaComentarios();
        $listaComentarios=[];
            while($fila_comen= $lista->fetch_array()){
                $comentario=new Comentario();
                $comentario->evento = $fila_comen['id_evento'];
                $comentario->id = $fila_comen['id'];
                $comentario->nombre =$fila_comen['usuario'];
                //$coment->email =$fila_comen['email'];
                $comentario->fecha = $fila_comen['fecha'];
                $comentario->texto = $fila_comen['comentario'];
                $comentario->editado = $fila_comen['modificado'];
                $listaComentarios[]=$comentario;
            }
        return $listaComentarios;
    }


    public static function sacarComentarioID($id){
        $comentario=new Comentario();
        $comentario=self::buscarComentarioID($id);

        $eventocompleto= new Evento();

            if($fila_comen= $comentario->fetch_array()){
                $comentario->evento = $fila_comen['id_evento'];
                $comentario->id = $fila_comen['id'];
                $comentario->nombre =$fila_comen['usuario'];
                //$coment->email =$fila_comen['email'];
                $comentario->fecha = $fila_comen['fecha'];
                $comentario->texto = $fila_comen['comentario'];
                $comentario->editado = $fila_comen['modificado'];
            }
        return $comentario;
    }
    
    public static function devolverListaUsuarios(){
        $usuariosArray= self::listaUsuarios();
        $listaUsuarios=[];

            while($filanomb = $usuariosArray->fetch_array(MYSQLI_ASSOC)){
                $usuario= new Usuario();
                $usuario->nombre=$filanomb['nombre'];
                $usuario->contrasenia=$filanomb['contrasenia'];
                $usuario->email=$filanomb['email'];
                $usuario->moderador=$filanomb['moderador'];
                $usuario->gestor_sitio=$filanomb['gestor_sitio'];
                $usuario->super=$filanomb['super'];
                $listaUsuarios[]= $usuario;
                
            }
        return $listaUsuarios;
    }

    public static function devolverUsuario($nombre){
        $usuariosArray= self::buscarUsuario($nombre);
            $usuario= new Usuario();
            if($filanomb = $usuariosArray->fetch_array(MYSQLI_ASSOC)){

                $usuario->nombre=$filanomb['nombre'];
                $usuario->contrasenia=$filanomb['contrasenia'];
                $usuario->email=$filanomb['email'];
                $usuario->moderador=$filanomb['moderador'];
                $usuario->gestor_sitio=$filanomb['gestor_sitio'];
                $usuario->super=$filanomb['super'];
                
            }else
                $usuario=null;
        return $usuario;
    }

    public static function devolverPalabras(){
        $palabras= self::buscarPalabras();
        $listaPalabras=[];

            while($pala = $palabras->fetch_array(MYSQLI_ASSOC)){
                $listaEventos[]= $pala['palabra'];  
            }
        return $listaEventos;
    }
    


    /////////////////////////////////////
    //////Funciones para SQL////////////////
    public static function buscarEvento($id){
        $eventosPrepare = self::$conexion->prepare("Select * FROM Evento Where Evento.id = ?");
        $eventosPrepare->bind_param("i", $id);
        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$event = $result->fetch_assoc();
        $eventosPrepare->close();
        return $result;
    }

    public static function buscarEtiquetasEvento($id){
        $eventosPrepare = self::$conexion->prepare("Select * FROM Etiqueta Where id_evento = ?");
        $eventosPrepare->bind_param("i", $id);
        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$event = $result->fetch_assoc();
        $eventosPrepare->close();
        return $result;
    }
    public static function buscarListaEventos($publicado=1){
        if($publicado!=0 && $publicado!=1){
            $eventosPrepare = self::$conexion->prepare("Select * FROM Evento");
        }else{
            $eventosPrepare = self::$conexion->prepare("Select * FROM Evento WHERE publicado=?");
            $eventosPrepare->bind_param("i", $publicado);
        }
        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$result = $result->fetch_array();
        $eventosPrepare->close();
        return $result;
    }
    public static function listaEventosBusqueda($publicado=1,$palabras){
        $palabras="%{$palabras}%";
       if($publicado!=0 && $publicado!=1){
            $eventosPrepare = self::$conexion->prepare("Select * FROM Evento WHERE (nombre LIKE ?) OR (titulo LIKE ?) OR (texto LIKE ?)");
            $eventosPrepare->bind_param("sss",$palabras,$palabras,$palabras);
        }else{
            $eventosPrepare = self::$conexion->prepare("Select * FROM Evento WHERE publicado=? AND (nombre LIKE ? OR titulo LIKE ? OR texto LIKE ?)");
            $eventosPrepare->bind_param("isss", $publicado,$palabras,$palabras,$palabras);
        }
        //$eventosPrepare = self::$conexion->prepare("Select * FROM Evento WHERE publicado=? AND ( CONTAINS(nombre,?) OR CONTAINS(titulo,?) OR CONTAINS(fecha,?) OR CONTAINS(texto,?) OR CONTAINS(autor,?))");
        //$eventosPrepare->bind_param("isssss", $publicado,$palabras,$palabras,$palabras,$palabras,$palabras);
        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$result = $result->fetch_array();
        $eventosPrepare->close();
        return $result;
    }


    public static function buscarImagenesEvento($id){
            $eventosPrepare = self::$conexion->prepare("Select * FROM Imagenes Where Imagenes.id_evento = ?");
        $eventosPrepare->bind_param("i", $id);
        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$result = $result->fetch_array();
        $eventosPrepare->close();
        return $result;
    }

    public static function buscarComentarioEvento($id){
            $eventosPrepare = self::$conexion->prepare("Select * FROM Comentario Where Comentario.id_evento = ?");
        $eventosPrepare->bind_param("i", $id);
        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$result = $result->fetch_array();
        $eventosPrepare->close();
        return $result;
    }
        public static function listaComentarios(){
            $eventosPrepare = self::$conexion->prepare("Select * FROM Comentario ");
        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$result = $result->fetch_array();
        $eventosPrepare->close();
        return $result;
    }

        public static function buscarComentarioID($id){
            $eventosPrepare = self::$conexion->prepare("Select * FROM Comentario Where Comentario.id = ?");
            $eventosPrepare->bind_param("i", $id);
            $eventosPrepare->execute();
            $result = $eventosPrepare->get_result(); 
            //$result = $result->fetch_array();
            $eventosPrepare->close();
            return $result;
    }

    public static function buscarPalabras(){
        $eventosPrepare = self::$conexion->prepare("Select palabra FROM PalabrasProhibidas");
        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$result = $result->fetch_assoc();
        $eventosPrepare->close();
        return $result;
    }

    public static function listaUsuarios(){
        $eventosPrepare = self::$conexion->prepare("Select * FROM Usuario");
        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$event = $result->fetch_assoc();
        $eventosPrepare->close();
        return $result;
    }

    public static function buscarUsuario($nick){
        $eventosPrepare = self::$conexion->prepare("Select * FROM Usuario WHERE nombre = ?");
        $eventosPrepare->bind_param("s", $nick);
        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$event = $result->fetch_assoc();
        $eventosPrepare->close();
        return $result;
    }

    //ANIADIR
    public static function aniadirUsuario($usuario){
        
        $eventosPrepare = self::$conexion->prepare(
            "INSERT INTO Usuario (nombre, contrasenia,email,registrado,moderador,gestor_sitio,super) VALUES (?,?,?,1,?,?,?)" );

        $eventosPrepare->bind_param("sssiii", 
            $usuario->nombre, password_hash($usuario->contrasenia,PASSWORD_DEFAULT), $usuario->email,
            $usuario->moderador, $usuario->gestor_sitio, $usuario->super);

        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$event = $result->fetch_assoc();
        $eventosPrepare->close();
        return $result;
    }


    public static function aniadirEvento($titulo,$nombre,$fecha,$autor,$texto,$linkEvento,$twitter,$publicado=false){
        $eventosPrepare = self::$conexion->prepare(
            "INSERT INTO Evento (nombre,titulo,fecha,fecha_publicacion,texto,autor,linkEvento,twitter,publicado) VALUES (?,?,?,NOW(),?,?,?,?,?)" );
        $eventosPrepare->bind_param("sssssssi", $nombre,$titulo,$fecha,$texto,$autor,$linkEvento,$twitter,$publicado);

        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$event = $result->fetch_assoc();
        $eventosPrepare->close();

        $eventosPrepare = self::$conexion->prepare(
            "Select max(id) as id from Evento" );
        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        if($filaimg = $result->fetch_array(MYSQLI_ASSOC))
            $id=$filaimg["id"];
        else
            $id=0;

        $eventosPrepare->close();
        return $id;
    }

    public function aniadirEtiqueta($id,$nombre){    
        $eventosPrepare = self::$conexion->prepare(
            "INSERT INTO Etiqueta (id_evento,nombre) VALUES (?,?)" );
        $eventosPrepare->bind_param("is", $id,$nombre);

        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$event = $result->fetch_assoc();
        $eventosPrepare->close();

        return $id;  
    }
    
    public function subirImagen($id,$file_name,$cabecera){
        $eventosPrepare = self::$conexion->prepare(
            "INSERT INTO Imagenes (id_evento,img,descripcion) VALUES (?,?,?)" );
        $eventosPrepare->bind_param("iss", $id,$file_name,$cabecera);

        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$event = $result->fetch_assoc();
        $eventosPrepare->close();

        return $id;       
    }
    
    public static function aniadirComentario($comentario){
        
        $eventosPrepare = self::$conexion->prepare(
            "INSERT INTO Comentario (id_evento,usuario,email,fecha,comentario,modificado) VALUES (?,?,?,NOW(),?,0)" );
            //NOTA ARREGLAR FECHA
        $eventosPrepare->bind_param("isss", $comentario->evento,$comentario->nombre,$comentario->email,$comentario->texto);

        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$event = $result->fetch_assoc();
        $eventosPrepare->close();
        return $result;
    }


    public static function editarUsuario($usuario, $nuevoUsuario){
        
        $eventosPrepare = self::$conexion->prepare(
            "update Usuario SET nombre=?, email=?,moderador=?,gestor_sitio=?,super=? WHERE nombre=?");
        $eventosPrepare->bind_param("ssiiis", 
            $nuevoUsuario->nombre, $nuevoUsuario->email,
            $nuevoUsuario->moderador, $nuevoUsuario->gestor_sitio, $nuevoUsuario->super, $usuario->nombre);

        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$event = $result->fetch_assoc();
        $eventosPrepare->close();
        return $result;
    }

    public static function editarPermisos($nombre, $moderador,$gestor,$super){
        
        $eventosPrepare = self::$conexion->prepare(
            "update Usuario SET moderador=?,gestor_sitio=?,super=? WHERE nombre=?");
        $eventosPrepare->bind_param("iiis", $moderador,$gestor,$super,$nombre);

        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$event = $result->fetch_assoc();
        $eventosPrepare->close();
        return $result;
    }


    public static function editarContraseña($nombre, $contraseña){
        
        $eventosPrepare = self::$conexion->prepare(
            "update Usuario SET contrasenia=? WHERE nombre=?");
        $eventosPrepare->bind_param("ss",password_hash($contrasenia,PASSWORD_DEFAULT),$nombre);

        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$event = $result->fetch_assoc();
        $eventosPrepare->close();
        return $result;
    }


    public static function editarEvento($id,$titulo,$nombre,$fecha,$autor,$texto,$linkEvento,$twitter){
        $eventosPrepare = self::$conexion->prepare(
            "update Evento SET nombre=?, titulo=?,fecha=?,texto=?,autor=?,linkEvento=?,twitter=? WHERE id=?");
        $eventosPrepare->bind_param("sssssssi", $nombre,$titulo,$fecha,$texto,$autor,$linkEvento,$twitter,$id);

        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$event = $result->fetch_assoc();
        $eventosPrepare->close();
        return $result;
    }

    public static function cambiarEstadoEvento($ev,$estado){
        $eventosPrepare = self::$conexion->prepare(
            "update Evento SET publicado=? WHERE id=?");
        $eventosPrepare->bind_param("ii", $estado,$ev);

        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$event = $result->fetch_assoc();
        $eventosPrepare->close();
        return $result;
    }


    public static function editarComentario($id, $nombre,$texto){
        //$id=18;
        $eventosPrepare = self::$conexion->prepare(
            "Update Comentario SET usuario=?,comentario=?, modificado=1 WHERE id=?");
        $eventosPrepare->bind_param("ssi", $nombre ,$texto,$id);

        $eventosPrepare->execute();
        $result = $eventosPrepare->get_result(); 
        //$event = $result->fetch_assoc();
        $eventosPrepare->close();
        return $result;
    }



        //ELIMINAR

        public static function eliminarEvento($id){

            $eventosPrepare = self::$conexion->prepare("Delete FROM Etiqueta WHERE id_evento = ? ");
            $eventosPrepare->bind_param("i",$id);

            $eventosPrepare->execute();

            $eventosPrepare = self::$conexion->prepare("Delete FROM Imagenes WHERE id_evento = ? ");
            $eventosPrepare->bind_param("i",$id);

            $eventosPrepare->execute();

            $eventosPrepare = self::$conexion->prepare("Delete FROM Comentario WHERE id_evento = ? ");
            $eventosPrepare->bind_param("i",$id);

            $eventosPrepare->execute();
            
            $eventosPrepare = self::$conexion->prepare("Delete FROM Evento WHERE id = ? ");
            $eventosPrepare->bind_param("i",$id);

            $eventosPrepare->execute();


            $result = $eventosPrepare->get_result(); 
            //$event = $result->fetch_assoc();
            $eventosPrepare->close();
            return $result;
        }

        public static function eliminarComentario($id){
            $eventosPrepare = self::$conexion->prepare("Delete FROM Comentario WHERE id = ? ");
            $eventosPrepare->bind_param("i",$id);

            $eventosPrepare->execute();

            $result = $eventosPrepare->get_result(); 
            //$event = $result->fetch_assoc();
            $eventosPrepare->close();
            return $result;
        }

        public static function eliminarUsuario($nick){
            $eventosPrepare = self::$conexion->prepare("Delete FROM Usuario WHERE nombre = ? ");
            $eventosPrepare->bind_param("s",$nick);

            $eventosPrepare->execute();

            $result = $eventosPrepare->get_result(); 
            //$event = $result->fetch_assoc();
            $eventosPrepare->close();
            return $result;
        }

    public static function eliminarEtiqueta($id,$eti){      
            $eventosPrepare = self::$conexion->prepare("Delete FROM Etiqueta WHERE id_evento=? AND nombre = ? ");
            $eventosPrepare->bind_param("is",$id,$eti);

            $eventosPrepare->execute();

            $result = $eventosPrepare->get_result(); 
            //$event = $result->fetch_assoc();
            $eventosPrepare->close();
            return $result;
    }
}


?>
