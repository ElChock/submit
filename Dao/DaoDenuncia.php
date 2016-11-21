<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoDenuncia
 *
 * @author Ayrton
 */
include_once 'MySqlCon.php';
include_once '../Model/Denuncia.php';
include_once '../Model/V_publicacion.php';
class DaoDenuncia {
    
    function AltaDenuncia(Denuncia $denuncia)
    {
        $conn= new MySqlCon();
        $connect = $conn->connect();
         if(mysqli_connect_errno())
        {
            printf("Error de conexion: %s\n", mysqli_connect_error());
        }
        else
        {
            $stmt=$connect->prepare("call spa_denuncia(?,?)");
            $stmt->bind_param("ii", $denuncia->getIdUsuario(),$denuncia->getIdPublicacion());
            if($stmt->execute())
            {
                
            }
            else 
            {
                echo $stmt->error;
            }
        }       
    }
    
    function BuscarDenuncia()
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
            $stmt=$connect->prepare("call sp_BuscarDenuncias()");
            if($stmt->execute())
            {
                $stmt->bind_result($idPublicacion,$idUsuario,$descripcion,$titulo,$path,$tipoContenido,$fecha,$fotoPerfil,$nombre,$publico,$like);

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
                    $usuario->setFotoPerfil(base64_encode($fotoPerfil));
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
    
    public function BajaDenuncia(Denuncia $denuncia)
    {
        $conn = new MySqlCon();
        $connect= $conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        }
        else 
        {
            $stmt=$connect->prepare("call spb_denuncia(?,?)");
            $stmt->bind_param("ii", $denuncia->getIdUsuario(),$denuncia->getIdPublicacion());
            if($stmt->execute())
            {
                
            }
            
            else
            {
                echo $stmt->error;
            }
        }
        $connect->close();
    }
}
