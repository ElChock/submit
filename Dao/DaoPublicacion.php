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
    //put your code here
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
}
