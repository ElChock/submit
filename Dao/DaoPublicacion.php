<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoPublicacion
 *
 * @author Ayrton
 */
include_once 'MySqlCon.php';
include_once '../Model/Publicacion.php';
include_once '../Model/V_publicacion.php';
include_once '../Model/Usuario.php';
include_once '../Model/Likes.php';
class DaoPublicacion {
    
    public function altaPublicacion(Publicacion $publicacion )
    {
        $conn = new MySqlCon();
        $connect= $conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        }
        else
        {
            $stmt=$connect->prepare("call spa_publicacion(?,?,?,?,?)");
            $stmt->bind_param("issss", $publicacion->getIdUsuario(),$publicacion->getDescripcion(),$publicacion->getTitulo(),$publicacion->getPath(),$publicacion->getTipoContenido());
            if($stmt->execute())
            {
                $connect->close();
            }
            else
            {
                $connect->close();
                echo $stmt->error;
            }
        }
        
    }
    
    public function BuscarPublicacion($idUsuario)
    {
        $listPublicacion=array();
        $conn = new MySqlCon();
        $connect = $conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        }
        else 
        {
            $stmt=$connect->prepare("call sp_buscarPublicacion($idUsuario)");
            if($stmt->execute())
            {
                $stmt->bind_result($idPublicacion,$idUsuario,$descripcion,$titulo,$path,$tipoContenido,$fecha,$fotoPerfil,$nombre,$like);

                $contador=0;
                while ($stmt->fetch())
                {
                    $publicacion=new Publicacion();
                    $usuario = new Usuario();
                    $vPublicacion= new V_publicacion();
                    $publicacion->setIdPublicacion($idPublicacion);
                    $publicacion->setIdUsuario($idUsuario);
                    $publicacion->setDescripcion($descripcion);
                    $publicacion->setTitulo($titulo);
                    $publicacion->setPath($path);
                    $publicacion->setTipoContenido($tipoContenido);
                    $publicacion->setFecha($fecha);
                    $usuario->setNombre($nombre);
                    $usuario->setFotoPerfil($fotoPerfil);
                    $vPublicacion->setLikes($like);
                    $vPublicacion->setPublicacion($publicacion);
                    $vPublicacion->setUsuario($usuario);
                    $listPublicacion[$contador]=$vPublicacion;
                    $contador++;
                } 
                return $listPublicacion;
            }

        }
            
    }
    
    public function BuscarPublicacionesPropias($idUsuario)
    {
        $listPublicacion=array();
        $conn= new MySqlCon();
        $connect= $conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        }
        else 
        {
            $stmt=$connect->prepare("call sp_buscarPublicacionesPropias($idUsuario)");
            if($stmt->execute())
            {
                $stmt->bind_result($idPublicacion,$idUsuario,$descripcion,$titulo,$path,$tipoContenido,$fecha,$fotoPerfil,$nombre,$like);

                $contador=0;
                while ($stmt->fetch())
                {
                    $publicacion=new Publicacion();
                    $usuario = new Usuario();
                    $vPublicacion= new V_publicacion();
                    $publicacion->setIdPublicacion($idPublicacion);
                    $publicacion->setIdUsuario($idUsuario);
                    $publicacion->setDescripcion($descripcion);
                    $publicacion->setTitulo($titulo);
                    $publicacion->setPath($path);
                    $publicacion->setTipoContenido($tipoContenido);
                    $publicacion->setFecha($fecha);
                    $usuario->setNombre($nombre);
                    $usuario->setFotoPerfil($fotoPerfil);
                    $vPublicacion->setLikes($like);
                    $vPublicacion->setPublicacion($publicacion);
                    $vPublicacion->setUsuario($usuario);
                    $listPublicacion[$contador]=$vPublicacion;
                    $contador++;
                } 
                return $listPublicacion;
            }
        }        
    }
    
    public function EliminarPublicacion($idPublicacion)
    {
        $conn=new MySqlCon();
        $connect=$conn->connect();
         if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        }
        else 
        {
            $stmt=$connect->prepare("call spb_publicacion($idPublicacion)");
            if(!$stmt->execute())
            {
                echo $stmt->error;
            }
        }       
    }
    
    public function BuscarPublicacionId($idPublicacion)
    {
        $conn= new MySqlCon();
        $connect = $conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexion: %s\n", mysqli_connect_error());
        }
        else
        {
            $stmt=$connect->prepare("call sp_buscarPublicacionId($idPublicacion)");
            if($stmt->execute())
            {
                $publicacion = new Publicacion();
                $usuario= new Usuario();
                $vPublicacion= new V_publicacion();
                $stmt->bind_result($idPublicacion,$idUsuario,$descripcion,$titulo,$path,$tipoContenido,$fecha,$fotoPerfil,$nombre,$like);
                $stmt->fetch();
                $publicacion->setDescripcion($descripcion);
                $publicacion->setFecha($fecha);
                $publicacion->setIdPublicacion($idPublicacion);
                $publicacion->setIdUsuario($idUsuario);
                $publicacion->setPath($path);
                $publicacion->setTipoContenido($tipoContenido);
                $publicacion->setTitulo($titulo);
                $usuario->setFotoPerfil($fotoPerfil);
                $usuario->setNombre($nombre);
                $vPublicacion->setLikes($like);
                $vPublicacion->setPublicacion($publicacion);
                $vPublicacion->setUsuario($usuario);
                
                $connect->close();
                return $vPublicacion;
            }
            else
            {
                $connect->close();
                echo $stmt->error;
            }
        }
    }
    
    public function BuscarPublicaciones($palabra,$fechaInicio,$fechaFin)
    {
        $conn= new MySqlCon();
        $connect=$conn->connect();
        if(mysqli_connect_errno())
        {
           printf("Error de conexion: %s\n", mysqli_connect_error()); 
        }
        else
        {
            try 
            {
                $vPublicacion= new V_publicacion();
                $stmt=$connect->prepare("call sp_bucarPublicaciones($palabra,$fechaInicio,$fechaFin)"); 
                if($stmt->execute())
                {
                    $publicacion = new Publicacion();
                    $usuario= new Usuario();
                    $vPublicacion= new V_publicacion();
                    $stmt->bind_result($idPublicacion,$idUsuario,$descripcion,$titulo,$path,$tipoContenido,$fecha,$fotoPerfil,$nombre,$like);
                    $stmt->fetch();
                    $publicacion->setDescripcion($descripcion);
                    $publicacion->setFecha($fecha);
                    $publicacion->setIdPublicacion($idPublicacion);
                    $publicacion->setIdUsuario($idUsuario);
                    $publicacion->setPath($path);
                    $publicacion->setTipoContenido($tipoContenido);
                    $publicacion->setTitulo($titulo);
                    $usuario->setFotoPerfil($fotoPerfil);
                    $usuario->setNombre($nombre);
                    $vPublicacion->setLikes($like);
                    $vPublicacion->setPublicacion($publicacion);
                    $vPublicacion->setUsuario($usuario);

                    $connect->close();
                    return $vPublicacion;
                }
                else
                {
                    $connect->close();

                }
                
            } 
            catch (Exception $exc) 
            {
                echo $exc->getTraceAsString();
            } 
            finally 
            {
                $connect->close();
            }

           
            
        }
    }
}
