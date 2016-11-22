<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoBusqueda
 *
 * @author Ayrton
 */
include_once 'MySqlCon.php';
include_once '../Model/Usuario.php';
class DaoBusqueda 
{
    public function BuscarPersona($nombre)
    {
        $conn= new MySqlCon();
        $connect=$conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexión: %s\n", mysqli_connect_error());
        }
        else
        {
            try 
            {
                $listUsuario = array();
                $stmt=$connect->prepare("call sp_buscarPersonas(?)");
                $stmt->bind_param("s", $nombre);
                        
                if($stmt->execute())
                {
                
                    $stmt->bind_result($idUsuario,$fotoPerfil,$nombre1,$apellidoPaterno,$descripcion,$nickname);
                    $contador=0;
                    while($stmt->fetch())
                    {
                        $usuario = new Usuario();
                        $usuario->setApellidoPaterno($apellidoPaterno);
                        $usuario->setDescripcion($descripcion);
                        $usuario->setFotoPerfil($fotoPerfil);
                        $usuario->setNickname($nickname);
                        $usuario->setNombre($nombre1);
                        $usuario->setIdUsuario($idUsuario);
                        $listUsuario[$contador]=$usuario;
                        $contador++;
                    }
                    return $listUsuario;                    
                }
                else
                {
                    echo $stmt->error;
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
