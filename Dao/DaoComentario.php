<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoComentario
 *
 * @author Ayrton
 */
include_once 'MySqlCon.php';
include_once '../Model/Comentario.php';
include_once '../Model/Usuario.php';
class DaoComentario {
    public function BuscarComentario($idPublicacion)
    {
        $listComentario= array();
        $conn= new MySqlCon();
        $connect = $conn->connect();
         if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        }
        else
        {
            $stmt=$connect->prepare("call sp_buscarComentario($idPublicacion) ");
            if($stmt->execute())
            {
                $contador=0;
                $stmt->bind_result($idPublicacion,$idUsuario,$comentarioS,$fecha,$fotoPerfil,$nombre);
                while($stmt->fetch())
                {
                    $comentario= new Comentario();
                    $usuario = new Usuario();
                    $comentario->setIdPublicacion($idPublicacion);
                    $comentario->setIdUsuario($idUsuario);
                    $comentario->setComentario($comentarioS);
                    $comentario->setFecha($fecha);
                    $usuario->setFotoPerfil($fotoPerfil);
                    $usuario->setNombre($nombre);
                    $comentario->setUsuario($usuario);
                            
                    $listComentario[$contador]=$comentario;
                    $contador++;
                }
                return $listComentario;
            }
            else 
            {
                echo $stmt->error;
            }
        }
    }
    
    public function AltaComentario(Comentario $comentario)
    {
        $conn= new MySqlCon();
        $connect = $conn->connect();
         if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        }
        else 
        {   
            $stmt=$connect->prepare("call spa_comentario(?,?,?)");
            $stmt->bind_param("iis",$comentario->getIdUsuario(), $comentario->getIdPublicacion(),$comentario->getComentario());
            if($stmt->execute())
            {
                echo "funciono el store";
            }
            else
            {
                echo $stmt->error;
            }
        }
    }
}
