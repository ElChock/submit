<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoNotificacion
 *
 * @author Ayrton
 */
include_once 'MySqlCon.php';
include_once '../Model/Notificacion.php';
class DaoNotificacion {
    public function BuscarNotificacion($idUsuario)
    {
        $conn= new MySqlCon();
        $connect = $conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexion: %s\n", mysqli_connect_error());
        }
        else
        {
            $stmt=$connect->prepare("call sp_obtenerNotificacion($idUsuario)");
            if($stmt->execute())
            {
                $listNotificacion = array();
                $stmt->bind_result($idNotificacion,$vista,$idUsuario,$idPublicacion,$fecha,$descripcion);
                $contador=0;
                while($stmt->fetch())
                {
                    $notificacion= new Notificacion();
                    $notificacion->setDescripcion($descripcion);
                    $notificacion->setFecha($fecha);
                    $notificacion->setIdNotificacion($idNotificacion);
                    $notificacion->setIdPublicacion($idPublicacion);
                    $notificacion->setIdUsuario($idUsuario);
                    $notificacion->setVista($vista);
                    $listNotificacion[$contador]=$notificacion;
                    $contador++;
                }
                $connect->close();
                return $listNotificacion;
                
            }
            else
            {
                $connect->close();
                echo $stmt->error;
            }
        }
    }
    
    public function MarcarNotificaciones($idNotificacion)
    {
        $conn= new MySqlCon();
        $connect= $conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexion: %s\n", mysqli_connect_error());
        }
        else 
        {
            try 
            {
                $stmt=$connect->prepare("call sp_marcarnotificaciones($idNotificacion)");
                if($stmt->execute())
                {
                    
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
    
    public  function MarcarTodasNotificaciones($idUsuario)
    {
        $conn= new MySqlCon();
        $connect=$conn->connect();
        if(mysqli_connect_errno())
        {
            printf("Error de conexion: %s\n", mysqli_connect_error());
        }
        else 
        {
            $stmt=$connect->prepare("call sp_marcarTodasNotificaciones($idUsuario)");
            if($stmt->execute())
            {
                
            }
            else
            {
                $connect->close();
                echo $stmt->error;
            }
            
        }
    }
}
